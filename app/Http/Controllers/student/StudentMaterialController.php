<?php

namespace App\Http\Controllers\student;

use App\Models\Course;
use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentMaterialController extends Controller
{
    public function index(Course $course)
    {
        $materials = $course->materials()->orderBy('id', 'asc')->paginate(10);
        $user = Auth::user();
        $total = $course->materials()->count();
        $completed = $user->readMaterials()->where('course_id', $course->id)->count();
        $progress = $total > 0 ? round(($completed / $total) * 100) : 0;

        return view('student.materials.index', compact('course', 'materials', 'progress', 'total', 'completed'));
    }

    public function show(Course $course, Material $material)
    {
        abort_unless($material->course_id === $course->id, 404);

        $previous = $course->materials()->where('id', '<', $material->id)->orderBy('id', 'desc')->first();
        $next = $course->materials()->where('id', '>', $material->id)->orderBy('id', 'asc')->first();

        if (!Auth::user()->readMaterials->contains($material->id)) {
            Auth::user()->readMaterials()->attach($material->id);
        }

        return view('student.materials.show', compact('course', 'material', 'previous', 'next'));
    }
}
