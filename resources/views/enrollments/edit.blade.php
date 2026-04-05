@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 40px auto; padding: 20px;">
    
    <h2 style="font-family: 'Audiowide', cursive; color: #A79277; text-transform: uppercase; margin-bottom: 30px; text-align: center;">
        Update Enrollment: <span style="color: #4b3f35;">{{ $enrollment->student_name }}</span>
    </h2>
    
    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" 
          style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(167, 146, 119, 0.1); border-bottom: 6px solid #A79277;">
        
        @csrf
        @method('PUT') 

        <div style="margin-bottom: 25px;">
            <label style="font-family: 'Orbitron', sans-serif; color: #A79277; display: block; margin-bottom: 8px; font-size: 0.8rem; letter-spacing: 1px;">
                STUDENT NAME:
            </label>
            <input type="text" name="student_name" value="{{ $enrollment->student_name }}" required 
                   style="width:100%; padding: 12px; border: 1px solid #e0d5c8; border-radius: 8px; font-family: 'Electrolize', sans-serif; background-color: #FFF2E1;">
        </div>

        <div style="margin-bottom: 30px;">
            <label style="font-family: 'Orbitron', sans-serif; color: #A79277; display: block; margin-bottom: 8px; font-size: 0.8rem; letter-spacing: 1px;">
                ENROLLMENT STATUS:
            </label>
            <select name="status" style="width:100%; padding: 12px; border: 1px solid #e0d5c8; border-radius: 8px; font-family: 'Electrolize', sans-serif; background-color: #FFF2E1;">
                <option value="Pending" {{ $enrollment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $enrollment->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Enrolled" {{ $enrollment->status == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
            </select>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between;">
            <button type="submit" class="btn" 
                    style="background: #A79277; color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-family: 'Audiowide', cursive; font-size: 0.9rem; transition: 0.3s;">
                UPDATE RECORD
            </button>
            
            <a href="{{ route('enrollments.index') }}" 
               style="font-family: 'Orbitron', sans-serif; color: #4b3f35; text-decoration: none; font-size: 0.8rem; font-weight: bold; letter-spacing: 1px;">
                ← CANCEL
            </a>
        </div>
    </form>
</div>
@endsection