<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(9);
        $user = Auth::user();
        $enrolledCourseIds = $user ? $user->enrollments()->pluck('course_id')->toArray() : [];

        return view('student.courses.index', compact('courses', 'enrolledCourseIds'));
    }

    public function show($id)
    {
        $course = Course::with('category')->findOrFail($id);

        $user = Auth::user();
        $enrolled = false;

        if ($user) {
            $enrolled = $user->enrollments()->where('course_id', $id)->exists();
        }

        return view('public.courses.show', compact('course', 'enrolled'));
    }
}
