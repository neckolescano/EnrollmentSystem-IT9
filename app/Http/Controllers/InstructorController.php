<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function create()
    {
        $departments = DB::table('departments')->get();
        return view('admin.instructors', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instructor_name' => 'required|string|max:255', // Changed from first/last
            'department_id'   => 'required|exists:departments,department_id',
        ]);

        DB::table('instructors')->insert([
            'instructor_name' => $request->instructor_name, // Changed from first/last
            'department_id'   => $request->department_id,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->route('admin.manage_enrollments')->with('success', 'Instructor registered!');
    }
}