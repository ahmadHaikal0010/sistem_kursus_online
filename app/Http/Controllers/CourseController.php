<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->take(10)->get();
        return view('courses', compact('courses'));
    }
}
