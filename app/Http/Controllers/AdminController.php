<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Section; // Make sure this model exists!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function create()
    {
        // Fetch real courses from your database
        $courses = DB::table('courses')->get(); 

        return view('admin.add_subject', compact('courses'));
    }

   public function storeSubject(Request $request)
    {
        $request->validate([
            'course_id'    => 'required',
            'subject_code' => 'required|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:255',
            'units'        => 'required|integer|min:1|max:5', // Added validation
        ]);

        // 1. Create the Subject
        $subject = new \App\Models\Subject();
        $subject->course_id = $request->course_id;
        $subject->subject_code = strtoupper($request->subject_code);
        $subject->subject_name = $request->subject_name;
        $subject->units = $request->units; // Changed from hard-coded 3 to the form input
        $subject->save();

        // 2. Auto-create the Section
        \App\Models\Section::create([
            'subject_id'    => $subject->subject_id, 
            'instructor_id' => 1, 
            'semester'      => '1st',
            'school_year'   => '2025-2026',
            'schedule'      => 'TBA',
            'capacity'      => 40
        ]);

        return redirect()->route('enrollments.step2')->with('success', 'Subject created with ' . $request->units . ' units!');
    }
}