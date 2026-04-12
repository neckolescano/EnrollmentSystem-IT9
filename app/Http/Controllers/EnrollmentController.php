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

    // STEP 1: Show Personal Profile Form
    public function showStep1() {
        $user = Auth::user();
        // Standardizing to user_id based on your previous error fixes
        $student = Student::where('user_id', $user->user_id)->first();
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

    // STEP 4: Review Page (Fixed the $step1 undefined error)
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

    // STEP 5: Success (Final Save)
    // ... existing methods (showStep1 to showStep4) stay the same ...

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

        DB::transaction(function () use ($period, $section_ids, $student) {
            $enrollment = new Enrollment();
            $enrollment->student_id = $student->student_id;
            $enrollment->semester = $period['semester'];
            $enrollment->school_year = $period['school_year'];
            $enrollment->enrollment_date = now();
            $enrollment->status = 'Pending';
            $enrollment->save();

            foreach ($section_ids as $id) {
                $detail = new EnrollmentDetail();
                $detail->enrollment_id = $enrollment->enrollment_id;
                $detail->section_id = $id;
                $detail->save();
            }
        });

        session()->forget(['student_profile', 'enrollment_period', 'selected_sections']);
        
        // This is the correct way to finish: 
        // 1. Logic finishes (POST) 2. Redirect happens (GET)
        return redirect()->route('enrollments.success');
    }

    public function success() {
        return view('enrollments.step5');
    }
}