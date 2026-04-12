@extends('layouts.app')

@push('styles')
<style>
    /* --- Main Page Container --- */
    .enrollment-main-container {
        padding-top: 0px;
        padding-bottom: 80px;
    }

    .stepper-horizontal {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 60px;
        position: relative;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .stepper-horizontal::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 10%;
        right: 10%;
        height: 3px;
        background-color: #e0e0e0;
        z-index: 1;
    }

    .step-unit {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2; 
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #fff;
        border: 3px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px auto;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: #888;
        transition: 0.4s ease;
    }

    /* Active state (Step 1) */
    .step-unit.active .step-circle {
        border-color: var(--um-maroon);
        background-color: var(--um-maroon);
        color: #fff;
        box-shadow: 0 0 0 5px rgba(128, 0, 0, 0.15);
    }

    .step-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: #666;
        text-transform: uppercase;
    }

    .active .step-label {
        color: var(--um-maroon);
    }

    .page-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 15px;
    }

    /* --- Form Styling --- */
    .integrated-form-wrapper {
        margin-top: 50px;
        border-top: 2px solid #eee;
        padding-top: 50px;
    }

    .selection-label {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.3rem;
        color: #444;
        margin-bottom: 25px;
        text-align: center;
    }

    .integrated-select {
        width: 100%;
        padding: 16px 20px;
        border-radius: 12px;
        border: 2px solid #ddd;
        font-size: 1.1rem;
        background-color: #fff;
        transition: 0.3s;
        appearance: none;
    }

    .integrated-select:focus {
        border-color: var(--um-gold);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
        outline: none;
    }

    .input-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--um-maroon);
        margin-bottom: 8px;
        display: block;
        letter-spacing: 1px;
    }

    .btn-proceed {
        background: var(--um-maroon);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 50px;
        width: 100%;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        margin-top: 40px;
        cursor: pointer;
        transition: 0.3s ease;
        box-shadow: 0 8px 25px rgba(128, 0, 0, 0.2);
    }

    .btn-proceed:hover {
        background: #600000;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(128, 0, 0, 0.3);
    }
</style>
@endpush

@section('content')
<div class="enrollment-main-container">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- 5-Step Stepper --}}
                <div class="stepper-horizontal">
                    <div class="step-unit active">
                        <div class="step-circle">01</div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">02</div>
                        <div class="step-label">Period</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">03</div>
                        <div class="step-label">Subjects</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">04</div>
                        <div class="step-label">Review</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">05</div>
                        <div class="step-label">Success</div>
                    </div>
                </div>

                <h1 class="page-title">Student Registration</h1>
                <p class="text-center text-muted">Complete your personal profile to initialize the enrollment process.</p>
                
                <div class="integrated-form-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h3 class="selection-label">Personal Information</h3>
                            
                            <form action="{{ route('enrollments.post.step1') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="input-label">FIRST NAME</label>
                                        <input type="text" name="first_name" class="integrated-select" value="{{ $student->first_name ?? '' }}" placeholder="Enter First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="input-label">LAST NAME</label>
                                        <input type="text" name="last_name" class="integrated-select" value="{{ $student->last_name ?? '' }}" placeholder="Enter Last Name" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="input-label">YEAR LEVEL</label>
                                    <select name="year_level" class="integrated-select" required>
                                        <option value="" disabled selected>Select Year Level...</option>
                                        @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year'] as $level)
                                            <option value="{{ $level }}" {{ ($student->year_level ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="input-label">CONTACT NUMBER</label>
                                    <input type="text" name="contact_number" class="integrated-select" value="{{ $student->contact_number ?? '' }}" placeholder="09xxxxxxxxx" required>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn-proceed">
                                            Next: Academic Period &rsaquo;
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection