<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseQuestionController;
use App\Http\Controllers\StudentAnswerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('courses', CourseController::class)->middleware('role:teacher');
        Route::get('/course/questions/create/{course}', [CourseQuestionController::class, 'create'])->middleware('role:teacher')->name('course.questions.create');
        Route::post('/course/questions/store/{course}', [CourseQuestionController::class, 'store'])->middleware('role:teacher')->name('course.questions.store');
        Route::resource('course-questions', CourseQuestionController::class)->middleware('role:teacher');
        Route::get('/course/students/{course}', [CourseStudentController::class, 'index'])->middleware('role:teacher')->name('course.students.index');
        Route::get('/course/students/create/{course}', [CourseStudentController::class, 'create'])->middleware('role:teacher')->name('course.students.create');
        Route::post('/course/students/store/{course}', [CourseStudentController::class, 'store'])->middleware('role:teacher')->name('course.students.store');

        Route::get('/learning', [LearningController::class, 'index'])->middleware('role:student')->name('learning.index');
        Route::get('/learning/report/{course}', [LearningController::class, 'report'])->middleware('role:student')->name('learning.report');
        Route::get('/learning/finished/{course}', [LearningController::class, 'finished'])->middleware('role:student')->name('learning.finished');
        Route::get('/learning/{course}/{question}', [LearningController::class, 'learning'])->middleware('role:student')->name('learning.course');
        Route::post('/learning/{course}/{question}', [StudentAnswerController::class, 'store'])->middleware('role:student')->name('learning.course.store');
    });
});

require __DIR__ . '/auth.php';
