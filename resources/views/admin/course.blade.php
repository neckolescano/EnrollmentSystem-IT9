@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px; border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 style="font-family: 'Orbitron'; color: #800000; font-weight: 700;">ADD NEW <span style="color: #d4af37;">COURSE</span></h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('admin.courses.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">COURSE NAME</label>
                    <input type="text" name="course_name" class="form-control border-0 bg-light py-2" placeholder="e.g., Bachelor of Science in Information Technology" required>
                </div>
                
                <div class="mb-4">
                    <label class="small fw-bold text-muted mb-1">DEPARTMENT</label>
                    <select name="department_id" class="form-select border-0 bg-light py-2">
                        <option value="" selected disabled>Select Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.manage_enrollments') }}" class="text-muted small fw-bold text-decoration-none">CANCEL</a>
                    <button type="submit" class="btn text-white px-4 py-2" style="background-color: #800000; font-family: 'Orbitron'; font-size: 0.8rem; border-radius: 6px;">
                        CREATE COURSE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection