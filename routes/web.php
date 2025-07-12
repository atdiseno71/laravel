<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\QuestionController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/exam/{category?}', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/exam/answer', [ExamController::class, 'storeAnswer'])->name('exam.answer');
    Route::get('/exam/results', [ExamController::class, 'results'])->name('exam.results');
    Route::post('/exam/start', [ExamController::class, 'startExam'])->name('exam.start');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('questions', QuestionController::class);
    });
});

require __DIR__.'/auth.php';
