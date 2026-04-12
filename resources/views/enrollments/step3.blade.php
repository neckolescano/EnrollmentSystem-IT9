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

    .step-unit.done .step-circle {
        border-color: var(--um-maroon);
        background-color: var(--um-maroon);
        color: #fff;
    }

    /* Active state (Step 2) */
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

    /* --- Table Styling --- */
    .integrated-table-wrapper {
        margin-top: 50px;
        border-top: 2px solid #eee;
        padding-top: 50px;
    }

    .subject-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .subject-table th {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        border-bottom: 2px solid var(--um-gold);
        padding: 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .subject-row td {
        padding: 20px 15px;
        border-bottom: 1px solid #eee;
        background: transparent;
        transition: 0.3s;
    }

    .subject-row:hover td {
        background-color: rgba(128, 0, 0, 0.03);
    }

    .custom-checkbox {
        width: 22px;
        height: 22px;
        accent-color: var(--um-maroon);
        cursor: pointer;
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
</style>
@endpush

@section('content')
<div class="enrollment-main-container">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- 5-Step Stepper --}}
                <div class="stepper-horizontal">
                    <div class="step-unit">
                        <div class="step-circle">01</div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">02</div>
                        <div class="step-label">Period</div>
                    </div>
                    <div class="step-unit active">
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

                <h1 class="page-title">Select Subjects</h1>
                <p class="text-center text-muted">Choose the sections you wish to enroll in for this period.</p>
                
                <div class="integrated-table-wrapper">
                    <form action="{{ route('enrollments.post.step3') }}" method="POST">
                        @csrf
                        
                        <table class="subject-table">
                            <thead>
                                <tr>
                                    <th width="80">SELECT</th>
                                    <th>CODE</th>
                                    <th>SUBJECT NAME</th>
                                    <th>SECTION</th>
                                    <th>SCHEDULE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $section)
                                <tr class="subject-row">
                                    <td class="text-center">
                                        <input type="checkbox" name="section_ids[]" value="{{ $section->section_id }}" class="custom-checkbox">
                                    </td>
                                    <td><strong>{{ $section->subject->subject_code }}</strong></td>
                                    <td>{{ $section->subject->subject_name }}</td>
                                    <td><span class="badge" style="background: #eee; color: #555;">{{ $section->section_name }}</span></td>
                                    <td class="text-muted small">{{ $section->schedule }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn-proceed">
                                    Review Selection &rsaquo;
                                </button>
                                <a href="{{ route('enrollments.step1') }}" class="btn btn-link mt-3 text-muted d-block">Back to Step 1</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection