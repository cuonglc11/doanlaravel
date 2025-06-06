<?php

use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Teacher\ExamsController;
use App\Http\Controllers\Teacher\HomeController as TeacherHomeController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\QuestionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::prefix('student')->middleware(['auth', 'can:student'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('student.home');
});

Route::prefix('admin')->group(function () {})->middleware(['auth', 'can:admin']);

Route::prefix('teacher')->middleware(['auth', 'can:teacher'])->group(function () {
    Route::get('/home', [TeacherHomeController::class, 'home'])->name('teacher.home');
    Route::get("/lesson/{id}", [LessonController::class, 'index'])->name('lesson.show');
    Route::get("/exams/{id}", [ExamsController::class, 'index'])->name('exams.show');
    Route::get('/question/{id}', [QuestionsController::class,  'index'])->name('question.show');
    Route::post('/store', [TeacherHomeController::class, 'store'])->name('teacher.store');
    Route::post('/lesson/store', [LessonController::class, 'store'])->name('lesson.store');
    Route::post('/exams/store', [ExamsController::class, 'store'])->name('exams.store');
    Route::post('/question/store', [QuestionsController::class, 'store'])->name('question.store');
});