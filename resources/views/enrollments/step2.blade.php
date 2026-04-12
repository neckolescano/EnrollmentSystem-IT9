@extends('layouts.app')

@push('styles')
<style>
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

    .page-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        text-align: center;
        margin-bottom: 50px;
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

    .integrated-select {
        width: 100%;
        padding: 16px 20px;
        border-radius: 12px;
        border: 2px solid #ddd;
        font-size: 1.1rem;
        background-color: #fff;
        margin-bottom: 25px;
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

                {{-- STEPPER --}}
                <div class="stepper-horizontal">
                    <div class="step-unit done">
                        <div class="step-circle">✔</div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-unit active">
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

                <h1 class="page-title">Initialize Enrollment</h1>
                <p class="page-subtitle">Please select your academic period to begin the process.</p>
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        {{-- FIXED: Changed action to step2 --}}
                        <form action="{{ route('enrollments.post.step2') }}" method="POST">
                            @csrf

                            <label class="input-label">DEPARTMENT</label>
                            <select id="department_select" name="department_id" class="integrated-select" required>
                                <option value="" disabled selected>Choose Department...</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                @endforeach
                            </select>

                            <label class="input-label">COURSE</label>
                            <select id="course_select" name="course_id" class="integrated-select" required disabled>
                                <option value="" disabled selected>Select Department first...</option>
                            </select>

                            {{-- Hidden Master List for Script --}}
                            <select id="course_master_list" style="display: none;">
                                @foreach($courses as $course)
                                    <option value="{{ $course->course_id }}" data-dept="{{ $course->department_id }}">
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="input-label">SEMESTER</label>
                            <select name="semester" class="integrated-select" required>
                                <option value="" disabled selected>Choose Semester...</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Summer">Summer</option>
                            </select>

                            <label class="input-label">SCHOOL YEAR</label>
                            <select name="school_year" class="integrated-select" required>
                                <option value="" disabled selected>Choose Academic Year...</option>
                                <option value="2025-2026">2025-2026</option>
                                <option value="2026-2027">2026-2027</option>
                            </select>

                            <button type="submit" class="btn-proceed">
                                Proceed to Subject Selection &rsaquo;
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    const deptSelect = document.getElementById('department_select');
    const courseSelect = document.getElementById('course_select');
    const masterList = document.getElementById('course_master_list');

    deptSelect.addEventListener('change', function() {
        const selectedDeptId = this.value;
        courseSelect.disabled = false;
        courseSelect.innerHTML = '<option value="" disabled selected>Choose Course...</option>';
        
        const masterOptions = masterList.querySelectorAll('option');
        masterOptions.forEach(option => {
            if (option.getAttribute('data-dept') == selectedDeptId) {
                const clone = option.cloneNode(true);
                courseSelect.appendChild(clone);
            }
        });
    });
};
</script>
@endsection