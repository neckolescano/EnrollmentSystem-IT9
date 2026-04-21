@extends('layouts.app')

@push('styles')
<style>
    .admin-content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 4%; /* This creates the left/right space for the whole page */
    }
    /* Card Container */
    .records-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        padding: 40px;
        margin-top: 30px;
    }

    /* Table Formatting */
    .um-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px; /* Adds space between rows */
    }

    .um-table th {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.8rem;
        color: var(--um-maroon);
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 10px 20px;
        border: none;
        text-align: left;
    }

    .um-table td {
        padding: 20px;
        background-color: #fcfcfc;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    /* Round the corners of the rows */
    .um-table tr td:first-child { border-left: 1px solid #eee; border-radius: 12px 0 0 12px; }
    .um-table tr td:last-child { border-right: 1px solid #eee; border-radius: 0 12px 12px 0; }

    /* Badge & Button Styling */
    .status-badge {
        background: #fff3cd;
        color: #856404;
        padding: 6px 15px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .btn-approve {
        background: var(--um-maroon);
        color: white !important;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 0.7rem;
        transition: 0.3s;
    }
    
    .btn-approve:hover {
        background: #600000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(128, 0, 0, 0.2);
    }
</style>
@endpush

@section('content')
<div class="admin-content-wrapper">
    <table class="um-table">
        <thead>
            <tr>
                <th style="width: 25%;">Student Name</th>
                <th style="width: 30%;">Course</th>
                <th style="width: 15%;">Year Level</th>
                <th style="width: 15%;">Date Submitted</th>
                <th style="width: 15%;">Status</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $record)
            <tr>
                <td class="fw-bold">{{ $record->first_name }} {{ $record->last_name }}</td>
                <td>{{ $record->course_name }}</td>
                <td>{{ $record->year_level }}</td>
                <td>{{ date('M d, Y', strtotime($record->created_at)) }}</td>
                <td>
                    <span class="status-badge">PENDING</span>
                </td>
                <td style="text-align: center; display: flex; gap: 5px; justify-content: center;">
                    <form action="{{ route('admin.records.approve', $record->enrollment_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">APPROVE</button>
                    </form>

                    <a href="{{ route('admin.records.edit', $record->enrollment_id) }}" class="btn btn-sm btn-primary">EDIT</a>

                    <form action="{{ route('admin.records.reject', $record->enrollment_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this enrollment?')">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">REJECT</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection