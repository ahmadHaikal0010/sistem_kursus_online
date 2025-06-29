<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // public function index()
    // {
    //     $courses = Course::with('category')->latest()->take(10)->get();
    //     return view('home', compact('courses'));
    // }

    public function index()
    {
        $courses = Course::with('category')->latest()->get();
        $user = Auth::user();
        $enrolledCourseIds = $user ? $user->enrollments()->pluck('course_id')->toArray() : [];

        return view('public.courses.index', compact('courses', 'enrolledCourseIds'));
    }

    public function show($id)
    {
        $course = \App\Models\Course::with('category')->findOrFail($id);

        $user = Auth::user();
        $enrolled = false;

        if ($user) {
            $enrolled = $user->enrollments()->where('course_id', $id)->exists();
        }

        return view('public.courses.show', compact('course', 'enrolled'));
    }

    public function materials($id)
    {
        $user = Auth::user();

        // Cek apakah siswa sudah mendaftar kursus ini
        $enrolled = $user->enrollments()->where('course_id', $id)->exists();

        if (! $enrolled) {
            abort(403, 'Kamu belum terdaftar di kursus ini.');
        }

        $course = Course::with('materials')->findOrFail($id); // nanti kita buat relasi materials
        return view('student.material', compact('course'));
    }
}
