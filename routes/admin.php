<?php
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogOutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminAccessAuth;
use App\Http\Middleware\AdminAccessGuest;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAccess;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => [AdminAccessGuest::class]], function () {

        Route::get('/', fn() => redirect()->route('admin.login'));

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

    });

    Route::group(['middleware' => [AdminAccessAuth::class]], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('logout', [LogOutController::class, 'logout'])->name('logout');
    });

});