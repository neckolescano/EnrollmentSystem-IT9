@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 500px; border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 style="font-family: 'Orbitron'; color: #800000;">ADD <span style="color: #d4af37;">DEPARTMENT</span></h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('admin.departments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="small fw-bold text-muted">DEPARTMENT NAME</label>
                    <input type="text" name="department_name" class="form-control border-0 bg-light" placeholder="e.g., College of Computing Education" required>
                </div>
                <button type="submit" class="btn text-white w-100 py-2" style="background-color: #800000; font-family: 'Orbitron'; font-size: 0.8rem;">SAVE DEPARTMENT</button>
            </form>
        </div>
    </div>
</div>
@endsection