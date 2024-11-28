<?php
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogOutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServerManagerController;
use App\Http\Controllers\Admin\UserController;
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

        Route::resource('users', UserController::class);

        Route::group(['prefix' => 'server', 'as' => 'server.'], function () {
            Route::get('/', [ServerManagerController::class, 'index'])->name('index');
            Route::post('clear-cache', [ServerManagerController::class, 'clearCache'])->name('clear-cache');
            Route::post('storage-link', [ServerManagerController::class, 'storageLink'])->name('storage-link');
            Route::post('optimize', [ServerManagerController::class, 'optimize'])->name('optimize');
            Route::post('migrate-fresh', [ServerManagerController::class, 'migrateFresh'])->name('migrate-fresh');
            Route::post('update', [ServerManagerController::class, 'updateProject'])->name('update');
        });

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile.edit');
            Route::put('profile', [ProfileController::class, 'profileUpdate']);
            Route::get('password', [ProfileController::class, 'password'])->name('password.change');
            Route::put('password', [ProfileController::class, 'passwordUpdate']);
        });

        Route::post('logout', [LogOutController::class, 'logout'])->name('logout');
    });

});