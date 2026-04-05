@extends('layouts.app')

@section('content')
<style>
    /* 1. MASTER CONTAINER - Just a container for your background */
    .homepage-master {
        width: 100%;
        min-height: 100vh;
        /* I am leaving the image path empty for you to layout */
        background-image: url('/images/your-background-here.png'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Electrolize', sans-serif;
        margin-top: -24px;
    }

    /* 2. TEXT LAYER - Forced to the left */
    .text-layer {
        width: 100%;
        min-height: 100vh;
        padding: 50px 10px; /* Side margin you liked */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Centers vertically on the screen */
        align-items: flex-start; /* Pushes everything to the LEFT */
        text-align: left;        /* Aligns text to the LEFT */
    }

    /* 3. HERO TEXT PLACEMENT */
    .hero-text-block {
        max-width: 650px;
        margin-bottom: 50px;
    }

    .welcome-label {
        color: #800000;
        font-family: 'Orbitron', sans-serif;
        font-size: 0.9rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
    }

    .hero-title {
        font-family: 'Orbitron', sans-serif;
        color: #1a1a1a;
        font-size: clamp(2.5rem, 5vw, 4rem); 
        line-height: 1.1;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .hero-title span { color: #d4af37; }

    .hero-description {
        color: #444;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    /* 4. BUTTONS PLACEMENT */
    .btn-group {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .btn-pill {
        background-color: #800000;
        color: white;
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-family: 'Orbitron', sans-serif;
        font-weight: bold;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .link-text {
        color: #1a1a1a;
        font-family: 'Orbitron', sans-serif;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: bold;
    }

    /* 5. BOTTOM INFO PLACEMENT - Side by side on the left */
    .bottom-info-container {
        display: flex;
        gap: 60px;
        max-width: 900px;
        margin-top: 40px;
    }

    .info-item { flex: 1; }

    .info-item h4 {
        font-family: 'Orbitron', sans-serif;
        color: #800000;
        font-size: 1rem;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .info-item p {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.5;
    }
</style>

<div class="homepage-master">
    <div class="text-layer">
        
        <div class="hero-text-block">
            <span class="welcome-label">Official Online Portal</span>
            <h1 class="hero-title">SECURE YOUR <span>FUTURE</span> STARTING TODAY</h1>
            <p class="hero-description">
                Join our academic community through the official UM Online Enrollment System. 
                Register your subjects, manage your student profile, and track your admission 
                progress all in one secure platform.
            </p>
            <div class="btn-group">
                <a href="{{ route('enrollments.create') }}" class="btn-pill">ENROLL NOW</a>
                <a href="{{ route('enrollments.index') }}" class="link-text">VIEW RECORDS →</a>
            </div>
        </div>

        <div class="bottom-info-container">
            <div class="info-item">
                <h4>ADMISSION NOW OPEN</h4>
                <p>New students and transferees may start their application for the 1st Semester, Academic Year 2026-2027 starting today.</p>
            </div>
            <div class="info-item">
                <h4>REGISTRATION GUIDE</h4>
                <p>Please ensure your digital requirements (ID photo, transcript, and clearance) are ready before starting the enrollment process.</p>
            </div>
        </div>

    </div>
</div>
@endsection