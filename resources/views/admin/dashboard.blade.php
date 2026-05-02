@extends('layouts.app')

@section('content')
<style>
    :root {
        --um-maroon: #800000;
        --um-gold: #d4af37;
        --surface: #ffffff;
    }

    /* Main container matching the staff layout */
    .admin-main-container { 
        padding-top: 40px; 
        padding-bottom: 80px; 
    }

    /* Standard Page Title */
    .admin-page-title {
        font-family: 'Orbitron', sans-serif;
        color: var(--um-maroon);
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 10px;
    }

    /* Stat Card Styling */
    .stat-card {
        border-radius: 15px;
        border: none;
        transition: 0.3s ease;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 30px;
        height: 100%;
        margin-bottom: 24px; /* Fixes vertical hugging */
        border-left: 5px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .stat-border-gold { border-left-color: var(--um-gold); }
    .stat-border-green { border-left-color: #27ae60; }

    /* Tech-style Labels */
    .table-label {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.7rem;
        color: #999;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 20px 25px;
        font-weight: 700;
    }

    /* Updated Table Container */
    .content-card {
        border-radius: 20px;
        background: var(--surface);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 0; 
        overflow: hidden;
        margin-top: 10px;
    }

    /* Custom Dashboard Table Layout */
    .custom-dashboard-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .custom-dashboard-table thead {
        background-color: #fafafa;
        border-bottom: 2px solid #eee;
    }

    .custom-dashboard-table tbody tr {
        border-bottom: 1px solid #f1f1f1;
        transition: background 0.2s;
    }

    .custom-dashboard-table tbody tr:hover {
        background-color: #fffdf9;
    }

    .cell-data {
        padding: 24px 25px;
        vertical-align: middle;
    }

    /* Course Name Styling */
    .course-name-text { 
        color: var(--um-maroon); 
        font-weight: 700; 
        font-size: 0.95rem; 
        text-transform: uppercase; 
    }

    /* Badge for Enrollment Count */
    .badge-count {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.65rem;
        padding: 8px 16px;
        border-radius: 4px;
        background: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
        font-weight: 700;
    }

    /* Action Buttons */
    .btn-details {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--um-maroon);
        text-decoration: none;
        border: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-block;
    }

    .btn-details:hover {
        background: var(--um-maroon);
        color: white;
        border-color: var(--um-maroon);
    }

    .action-link {
        color: var(--um-maroon);
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        transition: 0.2s;
        display: inline-block;
        margin-top: 10px;
    }

    .action-link:hover { color: var(--um-gold); text-decoration: underline; }
</style>

<div class="admin-main-container">
    <div class="container">
        
        <div class="text-center mb-5">
            <h1 class="admin-page-title">ADMIN <span style="color: var(--um-gold);">DASHBOARD</span></h1>
            <p class="text-muted">University Enrollment Overview & Statistics 2025-2026</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="stat-card stat-border-green">
                    <span class="table-label" style="padding:0; display:block; margin-bottom:10px;">Total Enrolled</span>
                    <h2 class="fw-bold my-2" style="color: #27ae60;">{{ $totalEnrolled ?? '0' }}</h2>
                    <p class="text-muted small mb-3">Confirmed academic records officially processed.</p>
                    <a href="{{ route('admin.enrollments.approved') }}" class="action-link">
                        VIEW MASTER LIST &rsaquo;
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stat-card stat-border-gold">
                    <span class="table-label" style="padding:0; display:block; margin-bottom:10px;">Pending Approvals</span>
                    <h2 class="fw-bold my-2" style="color: var(--um-gold);">{{ $pendingApprovals ?? '0' }}</h2>
                    <p class="text-muted small mb-3">Requests requiring registrar verification.</p>
                    <a href="{{ route('admin.manage_enrollments') }}" class="action-link">
                        MANAGE ENROLLMENTS &rsaquo;
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="table-label mb-3" style="padding-left:10px; color: var(--um-maroon);">Most Popular Courses</h4>
                <div class="content-card">
                    <div class="table-responsive">
                        <table class="custom-dashboard-table">
                            <thead>
                                <tr>
                                    <th class="table-label" style="width: 50%;">Course Name</th>
                                    <th class="table-label text-center" style="width: 30%;">Enrollment Count</th>
                                    <th class="table-label text-end" style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularCourses as $course)
                                <tr>
                                    <td class="cell-data course-name-text">
                                        {{ $course->course_name }}
                                    </td>
                                    <td class="cell-data text-center">
                                        <span class="badge-count">{{ $course->student_count }} STUDENTS</span>
                                    </td>
                                    <td class="cell-data text-end">
                                        {{-- Redirecting to Master List since Course Info doesn't exist --}}
                                        <a href="{{ route('admin.enrollments.approved') }}" class="btn-details">VIEW MASTER LIST</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="cell-data text-center text-muted py-5">
                                        No course data available yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection