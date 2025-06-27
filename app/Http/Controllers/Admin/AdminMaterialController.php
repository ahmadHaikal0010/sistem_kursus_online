<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    public function index(Course $course)
    {
        $materials = $course->materials;
        return view('admin.materials.index', compact('course', 'materials'));
    }

    public function create(Course $course)
    {
        return view('admin.materials.create', compact('course'));
    }
}
