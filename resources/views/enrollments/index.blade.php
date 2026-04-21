@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 style="font-family: 'Orbitron'; color: var(--um-maroon); font-weight: 700; letter-spacing: 1px;">My Enrollment History</h2>
        <p class="text-muted">Track your registration status and view your official study loads.</p>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; background: #fff;">
        <div style="height: 6px; background: var(--um-maroon);"></div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #fdfdfd; font-family: 'Orbitron'; font-size: 0.75rem; letter-spacing: 1px;">
                        <tr>
                            <th class="p-4 text-muted">SCHOOL YEAR</th>
                            <th class="p-4 text-muted">SEMESTER</th>
                            <th class="p-4 text-muted text-center">STATUS</th>
                            <th class="p-4 text-muted text-end">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td class="p-4 fw-bold text-dark" style="font-size: 1rem;">
                                {{ $enrollment->school_year }}
                            </td>
                            <td class="p-4 text-secondary">
                                {{ $enrollment->semester }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="badge" style="
                                    background: {{ $enrollment->status == 'Approved' ? '#d1e7dd' : '#fff3cd' }}; 
                                    color: {{ $enrollment->status == 'Approved' ? '#0f5132' : '#856404' }}; 
                                    font-size: 0.75rem; 
                                    padding: 8px 16px; 
                                    border-radius: 6px; 
                                    font-weight: 800;
                                    letter-spacing: 0.5px;">
                                    {{ strtoupper($enrollment->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-end">
                                <a href="{{ route('enrollments.show', $enrollment->enrollment_id) }}" 
                                   class="btn btn-sm px-4 py-2" 
                                   style="background: var(--um-maroon); color: white; border-radius: 8px; font-family: 'Orbitron'; font-size: 0.7rem; font-weight: 600; transition: 0.3s;">
                                    VIEW LOAD
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <small class="text-muted">If your status remains <strong>PENDING</strong> for more than 24 hours, please visit the Registrar's Office.</small>
    </div>
</div>

<style>
    /* Hover effect for the Action button */
    .btn-sm:hover {
        background: #600000 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15);
    }
    /* Subtle row hover */
    .table-hover tbody tr:hover {
        background-color: #fafafa;
    }
</style>
@endsection