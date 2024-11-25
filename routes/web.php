<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\User\Auth\LogOutController as UserLogoutController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');

Route::group(['middleware' => LocaleMiddleware::class], function () {

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login', [UserLoginController::class, 'create'])->name('login');
        Route::post('login', [UserLoginController::class, 'store']);

        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile.edit');
            Route::put('profile', [ProfileController::class, 'profileUpdate']);
            Route::get('password', [ProfileController::class, 'password'])->name('password.change');
            Route::put('password', [ProfileController::class, 'passwordUpdate']);
        });
        Route::post('logout', [UserLogoutController::class, 'destroy'])->name('logout');
    });


});


require __DIR__ . '/admin.php';