<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseLanguageController;
use App\Http\Controllers\Admin\CourseLevelController;
use App\Http\Controllers\Admin\CourseSubCategoryController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Models\CourseCategory;
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

        Route::resource('course-languages', CourseLanguageController::class);

        Route::resource('course-levels', CourseLevelController::class);

        Route::resource('course-categories', CourseCategoryController::class);

        Route::get('{courseCategory}/course-sub-categories', [CourseSubCategoryController::class, 'index'])->name('course-sub-categories.index');
        Route::get('{courseCategory}/course-sub-categories/create', [CourseSubCategoryController::class, 'create'])->name('course-sub-categories.create');
        Route::post('{courseCategory}/course-sub-categories/store', [CourseSubCategoryController::class, 'store'])->name('course-sub-categories.store');
        Route::get('{courseCategory}/course-sub-categories/edit/{courseSubCategory}', [CourseSubCategoryController::class, 'edit'])->name('course-sub-categories.edit');
        Route::put('{courseCategory}/course-sub-categories/update/{courseSubCategory}', [CourseSubCategoryController::class, 'update'])->name('course-sub-categories.update');
        Route::delete('course-sub-categories/destroy/{courseSubCategory}', [CourseSubCategoryController::class, 'destroy'])->name('course-sub-categories.destroy');


    });
