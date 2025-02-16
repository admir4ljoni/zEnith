<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/1', [CourseController::class, 'show']);


// FOR ADMIN
Route::get('/dashboard', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/course/create-or-edit/{id?}', [CourseController::class, 'edit'])->name('admin.course.edit');
Route::post('/admin/course/create', [CourseController::class, 'store'])->name('admin.course.store');
Route::patch('/admin/course/update/{id}', [CourseController::class, 'update'])->name('admin.course.update');
Route::delete('/admin/course/delete/{id}', [CourseController::class, 'destroy'])->name('admin.course.delete');

// Lessons
Route::get('/admin/course/{course_id}/lesson/create-or-edit/{id?}', [LessonController::class, 'edit'])->name('admin.course.lesson.edit');
Route::post('/admin/course/{course_id}/lesson/create', [LessonController::class, 'store'])->name('admin.course.lesson.store');
Route::patch('/admin/course/{course_id}/lesson/update/{id}', [LessonController::class, 'update'])->name('admin.course.lesson.update');
Route::delete('/admin/course/{course_id}/lesson/delete/{id}', [LessonController::class, 'destroy'])->name('admin.course.lesson.delete');

// Enrollment
Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollment.index');

// Users
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/admin/user/create', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
Route::patch('/admin/user/edit/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/backup/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('backup_dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
