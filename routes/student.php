<?php

use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "student", "as" => "student.", "middleware" => ["auth", "verified", "role:student"]], function () {

    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard.index');

});

