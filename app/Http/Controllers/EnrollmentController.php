<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll($id)
    {
        $user = Auth::user();

        if ($user->enrollments()->where('course_id', $id)->exists()) {
            return back()->with('info', 'Kamu sudah terdaftar di kursus ini.');
        }

        $user->enrollments()->create([
            'course_id' => $id,
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Berhasil mendaftar kursus!');
    }
}
