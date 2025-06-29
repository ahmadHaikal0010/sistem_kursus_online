<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;


class MaterialController extends Controller
{
    public function materials($id)
    {
        $user = Auth::user();

        // Cek apakah siswa sudah mendaftar kursus ini
        $enrolled = $user->enrollments()->where('course_id', $id)->exists();

        if (! $enrolled) {
            abort(403, 'Kamu belum terdaftar di kursus ini.');
        }

        $course = Course::with('materials')->findOrFail($id); // nanti kita buat relasi materials
        return view('student.materials.index', compact('course'));
    }
}
