<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && strcasecmp(trim($user->role), 'Administrator') === 0) {
            // Update these to lowercase 'approved' and 'pending'
            $totalEnrolled = \DB::table('enrollments')->where('status', 'approved')->count();
            $pendingApprovals = \DB::table('enrollments')->where('status', 'pending')->count();
            
            $popularCourses = \DB::table('courses')
                ->join('students', 'courses.course_id', '=', 'students.course_id')
                ->select('courses.course_name', \DB::raw('count(students.student_id) as student_count'))
                ->groupBy('courses.course_id', 'courses.course_name')
                ->orderBy('student_count', 'desc')
                ->limit(3)
                ->get();

            return view('admin.dashboard', compact('totalEnrolled', 'pendingApprovals', 'popularCourses'));
        }

        return view('home');
    }
}