@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px; border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 style="font-family: 'Orbitron'; color: #800000; font-weight: 700;">CREATE <span style="color: #d4af37;">SECTION & SCHEDULE</span></h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('admin.sections.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">SUBJECT</label>
                        <select name="subject_id" class="form-select border-0 bg-light py-2" required>
                            <option value="" selected disabled>Select Subject</option>
                            @foreach($subjects as $sub)
                                <option value="{{ $sub->subject_id }}">{{ $sub->subject_code }} - {{ $sub->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">INSTRUCTOR</label>
                        <select name="instructor_id" class="form-select border-0 bg-light py-2" required>
                            <option value="" selected disabled>Assign Instructor</option>
                            @foreach($instructors as $inst)
                                <option value="{{ $inst->instructor_id }}">{{ $inst->instructor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">SCHEDULE (TIME & DAYS)</label>
                    <input type="text" name="schedule" class="form-control border-0 bg-light py-2" placeholder="e.g., TTH 1:00 PM - 3:30 PM" required>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">ROOM</label>
                        <input type="text" name="room" class="form-control border-0 bg-light py-2" placeholder="e.g., Lab 402" required>
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">MAX CAPACITY</label>
                        <input type="number" name="capacity" class="form-control border-0 bg-light py-2" placeholder="40" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <a href="{{ route('admin.manage_enrollments') }}" class="text-muted small fw-bold text-decoration-none">CANCEL</a>
                    <button type="submit" class="btn text-white px-5 py-2" style="background-color: #800000; font-family: 'Orbitron'; font-size: 0.8rem; border-radius: 6px;">
                        SAVE SECTION
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection