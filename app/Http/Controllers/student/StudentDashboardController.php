<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = $user->enrollments()->with('course.category')->latest()->get();

        return view('student.dashboard', compact('courses'));
    }
}
