<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserEnrollmentController extends Controller
{
    public function index()
    {
        $users = User::with('courses')->where('role', 'siswa')->get();
        return view('admin.users.enrollments', compact('users'));
    }
}
