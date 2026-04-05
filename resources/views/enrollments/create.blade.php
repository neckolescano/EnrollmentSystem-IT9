@extends('layouts.app')
@section('content')
    <h1>New Student Enrollment</h1>
    <form action="{{ route('enrollments.store') }}" method="POST" style="background: white; padding: 2rem; border-radius: 8px;">
        @csrf
        <label>Student ID</label><br>
        <input type="text" name="student_id" required style="width:100%; padding:10px; margin:10px 0;"><br>
        <label>Student Name</label><br>
        <input type="text" name="student_name" required style="width:100%; padding:10px; margin:10px 0;"><br>
        <label>Semester</label><br>
        <select name="semester" style="width:100%; padding:10px; margin:10px 0;">
            <option>1st Semester</option>
            <option>2nd Semester</option>
        </select><br>
        <label>School Year</label><br>
        <input type="text" name="school_year" value="2025-2026" style="width:100%; padding:10px; margin:10px 0;"><br>
        <button type="submit" class="btn btn-add">Submit Enrollment</button>
    </form>
@endsection