<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {

});

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('login.google');

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

require __DIR__.'/auth.php';
