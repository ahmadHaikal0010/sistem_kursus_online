<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Middleware\RoleAdmin;
use App\Http\Middleware\RoleSiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard')->middleware('auth', RoleSiswa::class);

Route::get('/courses', [CourseController::class, 'courses'])->name('courses');
Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'enroll'])->middleware('auth')->name('enroll');

Route::get('/courses/{id}', [CourseController::class, 'show'])->name('show');

Route::get('/courses/{id}/material', [CourseController::class, 'materials'])->middleware('auth')->name('materials');

Route::middleware(['auth', RoleAdmin::class])->name('admin.')->group(function () {
    Route::get('/dashboardAdmin', [AdminController::class, 'dashboard'])->name('dashboardAdmin');

    Route::resource('/listcourses', AdminController::class);
    Route::get('/courses/{course}/materials', [AdminController::class, 'index'])->name('courses.materials.index');
    Route::get('/courses/{course}/materials/create', [AdminController::class, 'create'])->name('courses.materials.create');
    Route::post('/courses/{course}/materials', [AdminController::class, 'store'])->name('courses.materials.store');
});
