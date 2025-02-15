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

Route::get('/admin/course/create', [CourseController::class, 'create'])->name('admin.course.create');
Route::get('/admin/course/edit/', [CourseController::class, 'edit'])->name('admin.course.edit');

Route::get('/admin/course/lesson/create', [LessonController::class, 'edit'])->name('admin.course.lesson.create');
Route::get('/admin/course/lesson/edit', [LessonController::class, 'edit'])->name('admin.course.lesson.edit');

Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollment.index');

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/admin/user/create', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::patch('/admin/user/{id}/edit', [UserController::class, 'update'])->name('admin.user.update');

Route::get('/backup/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('backup_dashboard');


Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
