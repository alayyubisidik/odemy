<?php

use App\Http\Controllers\Frontend\InstructorDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "instructor", "as" => "instructor.", "middleware" => ["auth", "verified", "role:instructor"]], function () {

    Route::get('dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('switch-to-student', [InstructorDashboardController::class, 'switchToStudent'])->name('switch-to-student.index');

});


