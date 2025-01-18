<?php

use App\Features\MobileRechargeFeature;
use App\Features\NsdlPanFeature;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MobileRechargePlansController;
use App\Http\Controllers\User\NsdlController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\User\Auth\LogOutController as UserLogoutController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\MobileRechargeController;
use App\Http\Controllers\User\PanCardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\WebsiteController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::post('/', [WebsiteController::class, 'storeMessage']);

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

    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {

        Route::get('phonepe/redirect', [PaymentController::class, 'phonePeRedirect'])->name('phonepe.redirect');
        Route::get('razorpay/redirect', [PaymentController::class, 'razorPayRedirect'])->name('razorpay.redirect');
        Route::post('nicepe/redirect', [PaymentController::class, 'nicePeRedirect'])
            ->withoutMiddleware(['web'])->name('nicepe.redirect');
    });

    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
            Route::get('success', [PaymentController::class, 'paymentSuccess'])->name('success');
            Route::get('failed', [PaymentController::class, 'paymentFailed'])->name('failed');
        });

        if (MobileRechargeFeature::isEnabled()) {
            Route::group(['prefix' => 'mobile-recharge', 'as' => 'mobile-recharge.'], function () {
                Route::get('/', [MobileRechargeController::class, 'index'])->name('index');
                Route::get('/create', [MobileRechargeController::class, 'create'])->name('create');
                Route::post('/', [MobileRechargeController::class, 'store'])->name('store');
                Route::get('/{mobileRecharge}/show', [MobileRechargeController::class, 'show'])->name('show');
                Route::post('/fetch-Plans', MobileRechargePlansController::class)->name('fetch-plans');
            });
        }

        if (NsdlPanFeature::isEnabled()) {
            Route::group(['prefix' => 'nsdl', 'as' => 'nsdl.'], function () {

                Route::resource('pan-card', PanCardController::class)->parameters(['pan-card' => 'panCard']);
                
                Route::get('transaction-status',[NsdlController::class,'tnxStatus'])->name('transaction-status');
                Route::post('transaction-status',[NsdlController::class,'txnStatusProcess']);

                Route::get('pan-status',[NsdlController::class,'panStatus'])->name('pan-status');
                Route::post('pan-status',[NsdlController::class,'panStatusProcess']);
               
                Route::post('{panCard}/process',[NsdlController::class,'process'])->name('process');
                Route::get('{panCard}/response',[NsdlController::class,'response'])->name('response');

            });
        }

        Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('recharge', [WalletController::class, 'recharge'])->name('recharge');
            Route::post('recharge', [WalletController::class, 'rechargeProcess']);
        });

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile.edit');
            Route::put('profile', [ProfileController::class, 'profileUpdate']);
            Route::get('password', [ProfileController::class, 'password'])->name('password.change');
            Route::put('password', [ProfileController::class, 'passwordUpdate']);

            Route::get('charges', [ProfileController::class, 'charges'])->name('charges');
        });
        Route::post('logout', [UserLogoutController::class, 'destroy'])->name('logout');
    });


});


require __DIR__ . '/admin.php';