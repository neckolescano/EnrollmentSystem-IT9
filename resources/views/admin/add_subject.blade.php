@extends('layouts.app')

@push('styles')
<style>
    /* Main container matching your Step 1 layout */
    .admin-main-container { 
        padding-top: 40px; 
        padding-bottom: 80px; 
    }

    .admin-page-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 15px;
    }

    /* Integrated Input & Select Styling */
    .integrated-input {
        width: 100%;
        padding: 16px 20px;
        border-radius: 12px;
        border: 2px solid #ddd;
        font-size: 1.1rem;
        background-color: white; 
        transition: 0.3s;
        margin-bottom: 25px;
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
        box-shadow: 0 8px 25px rgba(128, 0, 0, 0.2);
    }

    .btn-save:hover {
        background: #600000;
        transform: translateY(-3px);
    }

    /* Success Alert Styling */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #c3e6cb;
        font-family: 'Outfit', sans-serif;
    }
</style>
@endpush

@section('content')
<div class="admin-main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <h1 class="admin-page-title">Subject Management</h1>
                <p class="text-center text-muted mb-5">Admin Tool: Add new subjects to the university database.</p>

                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="border-top: 2px solid #eee; padding-top: 50px;">
                    <form action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        
                        {{-- 1. Course Selection --}}
                        <div>
                            <label class="input-label">ASSIGN TO COURSE</label>
                            <select name="course_id" class="integrated-input" required>
                                <option value="" disabled selected>Select a Course...</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2. Subject Code --}}
                        <div>
                            <label class="input-label">SUBJECT CODE</label>
                            <input type="text" name="subject_code" class="integrated-input" placeholder="e.g., IT101" required>
                        </div>

                        {{-- 3. Subject Name --}}
                        <div>
                            <label class="input-label">SUBJECT NAME</label>
                            <input type="text" name="subject_name" class="integrated-input" placeholder="e.g., Web Development" required>
                        </div>

                        {{-- 4. Units Input --}}
                        <div>
                            <label class="input-label">UNITS</label>
                            <input type="number" name="units" class="integrated-input" placeholder="e.g., 3" min="1" max="5" required>
                        </div>

                        <button type="submit" class="btn-save">
                            Confirm and Add Subject &rsaquo;
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        {{-- Changed back-link to Dashboard or Management Index --}}
                        <a href="{{ route('dashboard') }}" class="text-muted small" style="text-decoration: none;">
                            &lsaquo; Back to Admin Dashboard
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection