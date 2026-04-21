<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function create()
    {
        $subjects = DB::table('subjects')->get();
        $instructors = DB::table('instructors')->get();
        
        return view('admin.sections', compact('subjects', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,subject_id',
            'instructor_id' => 'required|exists:instructors,instructor_id',
            'schedule' => 'required|string|max:255',
            'room' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
        ]);

        DB::table('sections')->insert([
            'subject_id' => $request->subject_id,
            'instructor_id' => $request->instructor_id,
            'schedule' => $request->schedule,
            'room' => $request->room,
            'capacity' => $request->capacity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.manage_enrollments')->with('success', 'Section/Schedule created successfully!');
    }
}