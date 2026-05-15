<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
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

        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::put('courses/{course}/update-approve-status', [CourseController::class, 'updateApproveStatus'])->name('courses.update-approve-status');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('courses/{course}/update', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('courses/{course}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy');

        Route::get('courses/{course}/chapters', [CourseController::class, 'chapterIndex'])->name('courses.chapters.index');
        Route::get('courses/{course}/chapters/create', [CourseController::class, 'chapterCreate'])->name('courses.chapters.create');
        Route::post('courses/{course}/chapters/store', [CourseController::class, 'chapterStore'])->name('courses.chapters.store');
        Route::get('courses/{course}/chapters/{chapter}/edit', [CourseController::class, 'chapterEdit'])->name('courses.chapters.edit');
        Route::put('courses/{course}/chapters/{chapter}/update', [CourseController::class, 'chapterUpdate'])->name('courses.chapters.update');
        Route::delete('courses/{course}/chapters/{chapter}/destroy', [CourseController::class, 'chapterDestroy'])->name('courses.chapters.destroy');

        Route::get('courses/{course}/chapters/{chapter}/lessons', [CourseController::class, 'lessonIndex'])->name('courses.lessons.index');
        Route::get('courses/{course}/chapters/{chapter}/lessons/create', [CourseController::class, 'lessonCreate'])->name('courses.lessons.create');
        Route::post('courses/{course}/chapters/{chapter}/lessons/store', [CourseController::class, 'lessonStore'])->name('courses.lessons.store');
        Route::delete('courses/{course}/chapters/{chapter}/lessons/{lesson}/destroy', [CourseController::class, 'lessonDestroy'])->name('courses.lessons.destroy');
        Route::get('courses/{course}/chapters/{chapter}/lessons/{lesson}/edit', [CourseController::class, 'lessonEdit'])->name('courses.lessons.edit');
        Route::put('courses/{course}/chapters/{chapter}/lessons/{lesson}/update', [CourseController::class, 'lessonUpdate'])->name('courses.lessons.update');
    });
