<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('courses', [CoursePageController::class, 'index'])->name('courses.index');
Route::get('courses/{slug}', [CoursePageController::class, 'show'])->name('courses.show');

Route::middleware('auth')->group(function () {

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{course}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('login.google');

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::group([
    'prefix' => 'filemanager'
], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


require __DIR__ . '/auth.php';
