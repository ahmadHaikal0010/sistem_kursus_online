<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        return view('admin.dashboard', compact('totalCourses'));
    }
}
