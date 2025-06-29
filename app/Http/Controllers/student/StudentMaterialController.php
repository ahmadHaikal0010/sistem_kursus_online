<?php

namespace App\Http\Controllers\student;

use App\Models\Course;
use App\Models\Material;
use App\Http\Controllers\Controller;

class StudentMaterialController extends Controller
{
    public function index(Course $course)
    {
        $materials = $course->materials()->orderBy('id')->paginate(10);

        return view('student.materials.index', compact('course', 'materials'));
    }

    public function show(Course $course, Material $material)
    {
        abort_unless($material->course_id === $course->id, 404);

        return view('student.materials.show', compact('course', 'material'));
    }
}
