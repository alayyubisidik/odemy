<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('users', UserController::class);

        Route::get('instructor-requests', [InstructorRequestController::class, 'index'])->name('instructor-requests.index');
        Route::post('instructor-requests/{user}/status', [InstructorRequestController::class, 'updateStatus'])
            ->name('instructor-requests.update-status');
        Route::get('instructor-requests/{user}/download', [InstructorRequestController::class, 'download'])
            ->name('instructor-requests.download');
    });
