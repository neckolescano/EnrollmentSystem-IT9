@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: #fff; overflow: hidden;">
        <div style="height: 10px; background: var(--um-maroon);"></div>
        
        <div class="p-5">
            <div class="text-center mb-5">
                <h4 class="fw-bold mb-1" style="color: var(--um-maroon); letter-spacing: 1px;">UNIVERSITY OF MINDANAO</h4>
                <h5 class="text-dark" style="font-family: 'Orbitron'; font-weight: 700; letter-spacing: 2px; font-size: 1.1rem;">CERTIFICATE OF REGISTRATION</h5>
                <div style="width: 60px; height: 3px; background: var(--um-gold); margin: 15px auto;"></div>
            </div>

            <div class="row mb-5 px-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Student Name</small>
                        <span class="fs-5 fw-bold" style="color: #333;">{{ strtoupper($student->first_name) }} {{ strtoupper($student->last_name) }}</span>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Year Level</small>
                        <span class="fw-bold text-dark">{{ $student->year_level }}</span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">School Year / Term</small>
                        <span class="fw-bold text-dark">{{ $enrollment->school_year }} / {{ $enrollment->semester }}</span>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Enrollment Status</small>
                        <span class="badge" style="background: {{ $enrollment->status == 'Approved' ? '#d1e7dd' : '#fff3cd' }}; color: {{ $enrollment->status == 'Approved' ? '#0f5132' : '#856404' }}; font-size: 0.8rem; padding: 8px 15px; border-radius: 6px;">
                            {{ strtoupper($enrollment->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead style="background: #fdfdfd; font-family: 'Orbitron'; font-size: 0.75rem;">
                        <tr class="text-center" style="color: var(--um-maroon);">
                            <th class="py-3" style="width: 15%;">CODE</th>
                            <th class="py-3" style="width: 35%;">DESCRIPTION</th>
                            <th class="py-3" style="width: 15%;">SECTION</th>
                            <th class="py-3" style="width: 25%;">SCHEDULE</th>
                            <th class="py-3" style="width: 10%;">UNITS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalUnits = 0; @endphp
                        @foreach($details as $item)
                        <tr>
                            <td class="text-center fw-bold py-3">{{ $item->subject_code }}</td>
                            <td class="px-3 py-3">{{ $item->subject_name }}</td>
                            <td class="text-center py-3">{{ $item->section_id }}</td>
                            <td class="text-center small py-3">{{ $item->schedule }}</td>
                            <td class="text-center fw-bold py-3">{{ $item->units }}</td>
                        </tr>
                        @php $totalUnits += $item->units; @endphp
                        @endforeach
                    </tbody>
                    <tfoot style="background: #fdfdfd; border-top: 2px solid #dee2e6;">
                        <tr class="fw-bold">
                            <td colspan="4" class="text-end py-4 px-4" style="letter-spacing: 1px; color: #666;">TOTAL ACADEMIC UNITS</td>
                            <td class="text-center py-4" style="color: var(--um-maroon); font-size: 1.2rem;">{{ $totalUnits }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="mt-5 pt-4 border-top text-center">
                <p class="text-muted mb-1" style="font-size: 0.8rem;">This is an official computer-generated document from the UM Enrollment System.</p>
                <p class="text-muted fw-bold" style="font-size: 0.75rem;">Generated on {{ date('F d, Y \a\t h:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection