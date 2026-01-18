<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonSessionController as AdminLessonSessionController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\BookingController;
use App\Http\Controllers\Teacher\LessonSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses', CourseController::class)->names('admin.courses');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses', CourseController::class)->names('admin.courses');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        default => redirect()->route('student.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/admin', 'dashboards.admin')->name('admin.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::view('/teacher', 'dashboards.teacher')->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('/student', 'dashboards.student')->name('student.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::resource('lesson-sessions', LessonSessionController::class);
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/sessions', [BookingController::class, 'sessions'])->name('sessions.index');
        Route::post('/sessions/{lesson_session}/book', [BookingController::class, 'store'])->name('sessions.book');
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class)
    ->only(['index', 'create', 'store', 'destroy']);

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => view('dashboards.admin'))->name('dashboard');

        Route::resource('courses', AdminCourseController::class);

        Route::resource('lesson-sessions', AdminLessonSessionController::class)
            ->only(['index', 'show', 'destroy']);

        Route::resource('teachers', AdminTeacherController::class)
            ->only(['index', 'create', 'store', 'destroy']);

        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::patch('/bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
        Route::patch('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
    });

/*
Route::get('/test-admin', function () {
    return 'ADMIN OK';
})->middleware(['auth', 'role:admin']);
*/

require __DIR__ . '/auth.php';
