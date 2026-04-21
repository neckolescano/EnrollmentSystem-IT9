@extends('layouts.app')

@push('styles')
<style>
    .admin-main-container { padding-top: 0px; padding-bottom: 80px; }
    .admin-page-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 15px;
    }
    .integrated-input {
        width: 100%;
        padding: 16px 20px;
        border-radius: 12px;
        border: 2px solid #ddd;
        font-size: 1.1rem;
        background-color: white;
        transition: 0.3s;
        margin-bottom: 25px;
        font-family: 'Outfit', sans-serif;
    }
    .integrated-input:focus {
        border-color: var(--um-gold);
        outline: none;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
    }
    .input-label {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.8rem;
        color: #888;
        margin-bottom: 8px;
        display: block;
        letter-spacing: 1px;
    }
    .btn-save {
        background: var(--um-maroon);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 50px;
        width: 100%;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 20px;
        cursor: pointer;
        transition: 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="admin-main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="admin-page-title">Register Student</h1>
                <p class="text-center text-muted mb-5">Admin Tool: Create accounts and assign academic profiles.</p>

                <div style="border-top: 2px solid #eee; padding-top: 50px;">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div style="display: flex; gap: 20px;">
                            <div style="flex: 1;">
                                <label class="input-label">FIRST NAME</label>
                                <input type="text" name="first_name" class="integrated-input" placeholder="e.g., Juan" required>
                            </div>
                            <div style="flex: 1;">
                                <label class="input-label">LAST NAME</label>
                                <input type="text" name="last_name" class="integrated-input" placeholder="e.g., Dela Cruz" required>
                            </div>
                        </div>

                        <label class="input-label">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="integrated-input" placeholder="e.g., juan@umindanao.edu.ph" required>

                        <div style="display: flex; gap: 20px;">
                            <div style="flex: 1;">
                                <label class="input-label">CONTACT NUMBER</label>
                                <input type="text" name="contact_number" class="integrated-input" placeholder="09123456789" required>
                            </div>
                            <div style="flex: 1;">
                                <label class="input-label">TEMPORARY PASSWORD</label>
                                <input type="password" name="password" class="integrated-input" required>
                            </div>
                        </div>

                        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                        {{-- DEPARTMENT IS BACK --}}
                        <label class="input-label">ASSIGN TO DEPARTMENT</label>
                        <select name="department_id" class="integrated-input" required>
                            <option value="" disabled selected>Select a Department...</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                            @endforeach
                        </select>

                        <label class="input-label">ASSIGN TO COURSE</label>
                        <select name="course_id" class="integrated-input" required>
                            <option value="" disabled selected>Select a Course...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>

                        <label class="input-label">YEAR LEVEL</label>
                        <select name="year_level" class="integrated-input" required>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>

                        <button type="submit" class="btn-save">
                            Confirm Registration &rsaquo;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection