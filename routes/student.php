<?php

use App\Http\Controllers\Frontend\MyLearningController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "student", "as" => "student.", "middleware" => ["auth", "verified", "role:student"]], function () {

    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profile', [StudentDashboardController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [StudentDashboardController::class, 'profileEdit'])->name('profile.edit');
    Route::put('profile/update', [StudentDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::put('profile/password/update', [StudentDashboardController::class, 'passwordUpdate'])->name('profile.password.update');

    Route::get('become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor.index');
    Route::post('become-instructor', [StudentDashboardController::class, 'becomeInstructorStore'])->name('become-instructor.store');
    Route::get('switch-to-instructor', [StudentDashboardController::class, 'switchToInstructor'])->name('switch-to-instructor.index');

    Route::get('my-learning', [MyLearningController::class, 'index'])->name('my-learning.index');
    Route::get('player/{slug}', [MyLearningController::class, 'playerIndex'])->name('player.index');
    Route::get('get-lesson-content', [MyLearningController::class, 'getLessonContent'])->name('get-lesson-content');
    Route::post('update-watch-history', [MyLearningController::class, 'updateWatchHistory'])->name('update-watch-history');
    Route::post('update-lesson-completion', [MyLearningController::class, 'updateLessonCompletion'])->name('update-lesson-completion');
    Route::get('get-certificate/{course}', [MyLearningController::class, 'getCertificate'])->name('get-certificate');
});
