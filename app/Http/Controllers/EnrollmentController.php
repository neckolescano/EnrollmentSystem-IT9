<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller {
    public function index() {
        $enrollments = Enrollment::all();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create() {
        return view('enrollments.create');
    }

    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required',
            'student_name' => 'required',
            'semester' => 'required',
            'school_year' => 'required',
        ]);
        Enrollment::create($request->all());
        return redirect()->route('enrollments.index');
    }

    public function edit(Enrollment $enrollment) {
        return view('enrollments.edit', compact('enrollment'));
    }

    public function update(Request $request, Enrollment $enrollment) {
        $enrollment->update($request->all());
        return redirect()->route('enrollments.index');
    }

    public function destroy(Enrollment $enrollment) {
        $enrollment->delete();
        return redirect()->route('enrollments.index');
    }
}