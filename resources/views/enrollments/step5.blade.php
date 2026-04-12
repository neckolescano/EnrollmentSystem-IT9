@extends('layouts.app')

@push('styles')
<style>
    /* --- Main Page Container --- */
    .enrollment-main-container {
        padding-top: 0px;
        padding-bottom: 80px;
    }

    /* --- Horizontal Stepper (UM Maroon Version) --- */
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
        background-color: var(--um-maroon); /* Line stays maroon */
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
        background-color: var(--um-maroon); /* All circles maroon */
        border: 3px solid var(--um-maroon);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px auto;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff;
    }

    .step-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--um-maroon);
        text-transform: uppercase;
    }

    /* --- Success Content Styling --- */
    .success-icon-wrapper {
        margin-top: 40px;
        margin-bottom: 20px;
    }

    .success-check {
        font-size: 5.5rem;
        color: var(--um-maroon);
        /* Adding a subtle gold glow instead of green shadow */
        text-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
    }

    .page-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 15px;
    }

    /* Badge using UM Gold accents */
    .status-badge {
        display: inline-block;
        background-color: #fffdf5;
        color: #856404;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        margin-top: 15px;
        border: 2px solid var(--um-gold);
    }

    .btn-home {
        background: var(--um-maroon);
        color: white;
        border: none;
        padding: 18px 50px;
        border-radius: 50px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        margin-top: 45px;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s ease;
        box-shadow: 0 8px 25px rgba(128, 0, 0, 0.2);
    }

    .btn-home:hover {
        background: #600000;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(128, 0, 0, 0.3);
    }
</style>
@endpush

@section('content')
<div class="enrollment-main-container">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                
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
                    <div class="step-unit">
                        <div class="step-circle">03</div>
                        <div class="step-label">Subjects</div>
                    </div>
                    <div class="step-unit">
                        <div class="step-circle">04</div>
                        <div class="step-label">Review</div>
                    </div>
                    <div class="step-unit active">
                        <div class="step-circle">05</div>
                        <div class="step-label">Success</div>
                    </div>
                </div>

                <div class="success-icon-wrapper">
                    <div class="success-check">✔</div>
                </div>

                <h1 class="page-title">Enrollment Successful!</h1>
                
                <p class="text-muted" style="font-size: 1.15rem; max-width: 600px; margin: 0 auto;">
                    Your application is now being processed. You will receive an update once the registrar has verified your selection.
                </p>

                <div class="status-badge">
                    APPLICATION STATUS: <span style="letter-spacing: 1px;">PENDING</span>
                </div>

                <div class="d-block">
                    <a href="{{ route('dashboard') }}" class="btn-home">
                        Return to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection