@extends('layouts.app')

@section('content')
    <h1 style="font-family: 'Monoton', cursive; color: #A79277;">Enrollment List</h1>
    
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $e)
            <tr>
                <td>{{ $e->student_id }}</td>
                <td>{{ $e->student_name }}</td>
                <td>{{ $e->semester }}</td>
                <td><strong>{{ $e->status }}</strong></td>
                <td>
                    <a href="{{ route('enrollments.edit', $e->id) }}" class="btn btn-edit">Update</a>

                    @if(Auth::user()->role == 'admin')
                        <form action="{{ route('enrollments.destroy', $e->id) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                Delete
                            </button>
                        </form>
                    @else
                        <span style="color: #A79277; font-size: 0.75rem; font-family: 'Orbitron', sans-serif; opacity: 0.6;">
                            [RESTRICTED]
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection