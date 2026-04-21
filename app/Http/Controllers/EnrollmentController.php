<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\EnrollmentDetail;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller {

    public function index()
    {
        // 1. Find the student profile for the logged-in user
        $student = DB::table('students')
            ->where('user_id', auth()->id())
            ->first();

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        // 2. Fetch all enrollments for this student
        $enrollments = DB::table('enrollments')
            ->where('student_id', $student->student_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('enrollments.index', compact('enrollments', 'student'));
    }

    public function show($id)
    {
        // 3. View specific enrollment details (The COR view)
        $enrollment = DB::table('enrollments')
            ->where('enrollment_id', $id)
            ->first();

        // Secure it: Make sure the enrollment belongs to the logged-in student
        $student = DB::table('students')->where('user_id', auth()->id())->first();
        if ($enrollment->student_id !== $student->student_id) {
            abort(403);
        }

        $details = DB::table('enrollment_details')
            ->join('sections', 'enrollment_details.section_id', '=', 'sections.section_id')
            ->join('subjects', 'sections.subject_id', '=', 'subjects.subject_id')
            ->join('instructors', 'sections.instructor_id', '=', 'instructors.instructor_id')
            ->where('enrollment_details.enrollment_id', $id)
            ->select('subjects.*', 'sections.*', 'instructors.instructor_name')
            ->get();

        return view('enrollments.show', compact('enrollment', 'details', 'student'));
    }
    
    // STEP 1: Show Personal Profile Form
    public function showStep1() {
    $user = Auth::user();
    $student = Student::where('user_id', $user->user_id)->first();

    // If student data exists, skip to Step 3 (Subject Selection)
    if ($student && $student->course_id) {
        // Automatically put the period info into the session so Step 3 works
        session(['enrollment_period' => [
            'course_id' => $student->course_id,
            'semester' => '1st Semester', // You can make this dynamic later
            'school_year' => '2025-2026'
        ]]);
        
        return redirect()->route('enrollments.step3');
    }

    return view('enrollments.step1', compact('student'));
    }

    public function postStep1(Request $request) {
        $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'year_level'     => 'required',
            'contact_number' => 'required',
        ]);

        $user = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'Please log in first.');

        $student = Student::updateOrCreate(
            ['user_id' => $user->user_id], 
            [
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'year_level'     => $request->year_level,
                'contact_number' => $request->contact_number,
            ]
        );

        session(['student_profile' => $request->only(['first_name', 'last_name', 'year_level', 'contact_number'])]);
        return redirect()->route('enrollments.step2');
    }

    // STEP 2: Show Academic Period
    public function showStep2() {
        $departments = DB::table('departments')->get();
        $courses = DB::table('courses')->get(); 
        return view('enrollments.step2', compact('departments', 'courses'));
    }

    public function postStep2(Request $request) {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,department_id',
            'course_id'     => 'required|exists:courses,course_id',
            'semester'      => 'required',
            'school_year'   => 'required',
        ]);

        $student = Auth::user()->student;
        $student->course_id = $request->course_id;
        $student->save();

        session(['enrollment_period' => $data]);
        return redirect()->route('enrollments.step3');
    }

    // STEP 3: Show Subjects
    public function showStep3() {
        $period = session('enrollment_period');
        if (!$period) return redirect()->route('enrollments.step2');

        $sections = Section::whereHas('subject', function($query) use ($period) {
            $query->where('course_id', $period['course_id']);
        })->with(['subject', 'instructor'])->get();

        return view('enrollments.step3', compact('sections'));
    }

    public function postStep3(Request $request) {
        $request->validate([
            'section_ids' => 'required|array|min:1'
        ]);

        // Standardizing session key to 'selected_sections' to match your store() method
        session(['selected_sections' => $request->section_ids]); 

        return redirect()->route('enrollments.step4');
    }

    // STEP 4: Review Page 
    public function showStep4() {
        $step1 = session('enrollment_period'); // This contains semester/year
        $profile = session('student_profile');
        $section_ids = session('selected_sections');

        // Safety redirect if data is missing
        if (!$step1 || !$section_ids) {
            return redirect()->route('enrollments.step3')->with('error', 'Please select subjects first.');
        }

        // Fetch actual Section objects so the review page can show names/codes
        $selectedSections = Section::with('subject')
            ->whereIn('section_id', $section_ids)
            ->get();

        return view('enrollments.step4', compact('step1', 'profile', 'selectedSections'));
    }

    // STEP 4 -> STEP 5: Success (Final Save)
    public function store(Request $request) {
        $period = session('enrollment_period'); 
        $section_ids = session('selected_sections');

        if (!$period || !$section_ids) {
            return redirect()->route('enrollments.step1')->with('error', 'Session expired.');
        }

        $student = \App\Models\Student::where('user_id', Auth::user()->user_id)->first();

        if (!$student) {
            return redirect()->route('enrollments.step1')->with('error', 'Student record not found.');
        }

        try {
            DB::transaction(function () use ($period, $section_ids, $student) {
                // 1. Create the Main Enrollment Header
                $enrollment = new Enrollment();
                $enrollment->student_id = $student->student_id;
                $enrollment->semester = $period['semester'];
                $enrollment->school_year = $period['school_year'];
                $enrollment->enrollment_date = now();
                $enrollment->status = 'Pending';
                $enrollment->save();

                // 2. Loop through sections and check capacity
                foreach ($section_ids as $id) {
                    $section = Section::lockForUpdate()->find($id); // Lock to prevent race conditions

                    // Count how many students are already in this section
                    $currentCount = EnrollmentDetail::where('section_id', $id)->count();

                    if ($currentCount >= $section->capacity) {
                        // If one section is full, we cancel the whole transaction
                        throw new \Exception("The section for subject " . $section->subject->subject_name . " is already full.");
                    }

                    // 3. Create the Detail link
                    $detail = new EnrollmentDetail();
                    $detail->enrollment_id = $enrollment->enrollment_id;
                    $detail->section_id = $id;
                    $detail->save();
                }
            });
        } catch (\Exception $e) {
            return redirect()->route('enrollments.step3')->with('error', $e->getMessage());
        }

        session()->forget(['student_profile', 'enrollment_period', 'selected_sections']);
        
        return redirect()->route('enrollments.success');
    }

    public function success() {
        return view('enrollments.step5');
    }
}