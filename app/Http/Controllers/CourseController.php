<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function create()
    {
        $departments = DB::table('departments')->get();
        return view('admin.course', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,department_id',
        ]);

        DB::table('courses')->insert([
            'course_name' => $request->course_name,
            'department_id' => $request->department_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.manage_enrollments')->with('success', 'Course added successfully!');
    }
}