<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function create()
    {
        return view('admin.departments');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);

        DB::table('departments')->insert([
            'department_name' => $request->department_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.manage_enrollments')->with('success', 'Department added successfully!');
    }
}