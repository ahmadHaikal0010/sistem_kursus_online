<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PublicCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->take(9)->get();

        return view('home', compact('courses'));
    }

    public function courses()
    {
        $courses = Course::with('category')->latest()->paginate(9);
        return view('public.courses.index', compact('courses'));
    }
}
