<?php

use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "instructor", "as" => "instructor.", "middleware" => ["auth", "verified", "role:instructor"]], function () {

    Route::get('dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profile', [InstructorDashboardController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [InstructorDashboardController::class, 'profileEdit'])->name('profile.edit');
    Route::put('profile/update', [InstructorDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::put('profile/password/update', [InstructorDashboardController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::put('profile/gateway-info', [InstructorDashboardController::class, 'storeGatewayInformation'])->name('profile.gateway-info.update');

    Route::get('switch-to-student', [InstructorDashboardController::class, 'switchToStudent'])->name('switch-to-student.index');

    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('courses/store-basic-info', [CourseController::class, 'storeBasicInfo'])->name('courses.store.basic-info');

    Route::get('courses/{course}/create-more-info', [CourseController::class, 'createMoreInfo'])->name('courses.create.more-info');
    Route::post('courses/store-more-info', [CourseController::class, 'storeMoreInfo'])->name('courses.store.more-info');

    Route::get('courses/{course}/create-course-content', [CourseController::class, 'createCourseContent'])->name('courses.create.course-content');

    Route::get('course-content/create-chapter', [CourseContentController::class, 'createChapter'])->name('course-content.create-chapter');
    Route::post('course-content/store-chapter', [CourseContentController::class, 'storeChapter'])->name('course-content.store-chapter');
    Route::put('course-content/update-chapter', [CourseContentController::class, 'updateChapter'])->name('course-content.update-chapter');
    Route::delete('course-content/{chapter}/destroy-chapter', [CourseContentController::class, 'destroyChapter'])->name('course-content.destroy-chapter');

    Route::get('course-content/create-lesson', [CourseContentController::class, 'createLesson'])->name('course-content.create-lesson');
    Route::post('course-content/store-lesson', [CourseContentController::class, 'storeLesson'])->name('course-content.store-lesson');
    Route::put('course-content/update-lesson', [CourseContentController::class, 'updateLesson'])->name('course-content.update-lesson');
    Route::delete('course-content/{lesson}/destroy-lesson', [CourseContentController::class, 'destroyLesson'])->name('course-content.destroy-lesson');
    Route::post('course-content/{chapter}/sort-lesson', [CourseContentController::class, 'sortLesson'])->name('course-content.sort-lesson');

    Route::get('courses/{course}/create-finish', [CourseController::class, 'createFinish'])->name('courses.create.finish');
    Route::post('courses/store-finish', [CourseController::class, 'storeFinish'])->name('courses.store.finish');

    Route::get('orders', [InstructorDashboardController::class, 'orderIndex'])->name('orders.index');

    Route::get('withdraws', [WithdrawController::class, 'index'])->name('withdraws.index');
    Route::get('withdraws/request', [WithdrawController::class, 'requestWithdraws'])->name('withdraws.request');
    Route::post('withdraws/request', [WithdrawController::class, 'storeRequestWithdraws'])->name('withdraws.request.store');
});
