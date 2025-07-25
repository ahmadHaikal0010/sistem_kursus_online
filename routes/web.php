<?php

use App\Http\Middleware\RoleAdmin;
use App\Http\Middleware\RoleSiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserEnrollmentController;
use App\Http\Controllers\student\StudentMaterialController;
use App\Http\Controllers\student\StudentDashboardController;

Route::get('/', [PublicCourseController::class, 'index']);

Route::get('/courses', [PublicCourseController::class, 'courses'])->name('courses');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// route auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', RoleSiswa::class])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/courses/{course}/materials', [StudentMaterialController::class, 'index'])->name('materials.index');
    Route::get('/courses/{course}/materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
});

Route::middleware(['auth', RoleAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('/courses', AdminCourseController::class);
    Route::get('/users/enrollments', [UserEnrollmentController::class, 'index'])->name('users.enrollments');
    Route::get('/courses/{course}/materials', [AdminMaterialController::class, 'index'])->name('courses.materials.index');
    Route::post('/courses/{course}/materials', [AdminMaterialController::class, 'store'])->name('courses.materials.store');
    Route::get('/courses/{course}/materials/create', [AdminMaterialController::class, 'create'])->name('courses.materials.create');
    Route::get('/courses/{course}/materials/{material}/edit', [AdminMaterialController::class, 'edit'])->name('courses.materials.edit');
    Route::get('/courses/{course}/materials/{material}', [AdminMaterialController::class, 'show'])->name('courses.materials.show');
    Route::put('/courses/{course}/materials/{material}', [AdminMaterialController::class, 'update'])->name('courses.materials.update');
    Route::delete('/courses/{course}/materials/{material}', [AdminMaterialController::class, 'destroy'])->name('courses.materials.destroy');
    Route::delete('users/enrollments/{user}/{course}', [UserEnrollmentController::class, 'unenroll'])->name('users.enrollments.unenroll');
});
