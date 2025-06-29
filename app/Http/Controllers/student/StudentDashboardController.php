<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = $user->courses()->with('materials')->paginate(10);

        $progressData = $courses->map(function ($course) use ($user) {
            $total = $course->materials->count();
            $completed = $user->readMaterials()->where('course_id', $course->id)->count();
            $progress = $total > 0 ? round(($completed / $total) * 100) : 0;

            return [
                'course' => $course,
                'total' => $total,
                'completed' => $completed,
                'progress' => $progress,
            ];
        });

        return view('student.dashboard', compact('progressData', 'courses'));
    }
}
