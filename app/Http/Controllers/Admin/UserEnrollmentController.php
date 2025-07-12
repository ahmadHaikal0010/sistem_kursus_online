<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;

class UserEnrollmentController extends Controller
{
    public function index()
    {
        $users = User::with('courses')->where('role', 'siswa')->get();
        return view('admin.users.enrollments', compact('users'));
    }

    public function unenroll(User $user, Course $course)
    {
        $user->courses()->detach($course->id);

        return redirect()->back()->with('success', 'Enroll berhasil dihapus');
    }
}
