<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PublicCourseController extends Controller
{
    public function index()
    {
        $latestCourses = Course::latest()->take(3)->get();
        return view('home', compact('latestCourses'));
    }

    public function courses()
    {
        $courses = Course::with('category')->latest()->paginate(9);
        return view('public.courses.index', compact('courses'));
    }
}
