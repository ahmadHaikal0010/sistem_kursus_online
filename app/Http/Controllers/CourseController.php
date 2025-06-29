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

        // Ambil course_id yang sudah diikuti oleh user
        $enrolledCourseIds = $user ? $user->courses()->pluck('course_id')->toArray() : [];

        return view('student.courses.index', compact('courses', 'enrolledCourseIds'));
    }

    public function show($id)
    {
        $course = Course::with('category')->findOrFail($id);

        $user = Auth::user();
        $enrolled = false;

        if ($user) {
            $enrolled = $user->courses()->where('course_id', $id)->exists();
        }

        return view('public.courses.show', compact('course', 'enrolled'));
    }

    public function enroll(Course $course)
    {
        $user = auth()->user();

        if (!$user->courses->contains($course->id)) {
            $user->courses()->attach($course->id);
        }

        return redirect()->route('student.materials.index', $course->id)
            ->with('success', 'Berhasil bergabung ke kursus!');
    }
}
