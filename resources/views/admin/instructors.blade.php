@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px; border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 style="font-family: 'Orbitron'; color: #800000;">ADD <span style="color: #d4af37;">INSTRUCTOR</span></h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('admin.instructors.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">FIRST NAME</label>
                        <input type="text" name="first_name" class="form-control border-0 bg-light" required>
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">LAST NAME</label>
                        <input type="text" name="last_name" class="form-control border-0 bg-light" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="small fw-bold text-muted">ASSIGNED DEPARTMENT</label>
                    <select name="department_id" class="form-select border-0 bg-light">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn text-white w-100 py-2" style="background-color: #800000; font-family: 'Orbitron'; font-size: 0.8rem;">REGISTER INSTRUCTOR</button>
            </form>
        </div>
    </div>
</div>
@endsection