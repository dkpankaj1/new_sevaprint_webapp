<?php
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogOutController;
use App\Http\Controllers\Admin\BalanceTransferController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\MobileRechargeController;
use App\Http\Controllers\Admin\OurServiceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServerManagerController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PanCardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TextSliderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Middleware\AdminAccessAuth;
use App\Http\Middleware\AdminAccessGuest;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => [AdminAccessGuest::class]], function () {

        Route::get('/', fn() => redirect()->route('admin.login'));
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

    });

    Route::group(['middleware' => [AdminAccessAuth::class]], function () {

        Route::resource('balance-transfer', BalanceTransferController::class);

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('pan-card', PanCardController::class)->only(['index','show']);

        Route::resource('users', UserController::class);

        Route::group(['prefix' => 'server', 'as' => 'server.'], function () {
            Route::get('/', [ServerManagerController::class, 'index'])->name('index');
            Route::post('clear-cache', [ServerManagerController::class, 'clearCache'])->name('clear-cache');
            Route::post('storage-link', [ServerManagerController::class, 'storageLink'])->name('storage-link');
            Route::post('optimize', [ServerManagerController::class, 'optimize'])->name('optimize');
            Route::post('migrate-fresh', [ServerManagerController::class, 'migrateFresh'])->name('migrate-fresh');
        });

        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::get('brand', [SettingController::class, 'brandSetting'])->name('brand');
            Route::post('brand', [SettingController::class, 'updateBrandSetting']);
            Route::get('general', [SettingController::class, 'generalSetting'])->name('general');
            Route::post('general', [SettingController::class, 'updateGeneralSetting']);
            Route::get('email', [SettingController::class, 'emailConfigurationSetting'])->name('email');
            Route::post('email', [SettingController::class, 'updateEmailConfigurationSetting']);

            Route::get('payment-getaway', [SettingController::class, 'paymentGetawaySetting'])->name('payment-getaway');
            Route::post('payment-getaway', [SettingController::class, 'updatePaymentGetawaySetting']);

        });

        Route::group(['prefix' => 'website', 'as' => 'website.'], function () {

            Route::get('/', [WebsiteSettingController::class, 'index'])->name('index');
            Route::post('/', [WebsiteSettingController::class, 'updateHomepage']);
            Route::resource('text-slider', TextSliderController::class);

            Route::get('about-us', [AboutUsController::class, 'edit'])->name('about-us.edit');
            Route::post('about-us', [AboutUsController::class, 'update'])->name('about-us.update');

            Route::resource('our-services', OurServiceController::class);
            Route::resource('videos', VideoController::class);

        });

        Route::get('feature', [FeatureController::class, 'index'])->name('feature.index');
        Route::get('feature/{feature}', action: [FeatureController::class, 'show'])->name('feature.show');
        Route::get('feature/{feature}/edit', [FeatureController::class, 'edit'])->name('feature.edit');
        Route::post('feature/{feature}/edit', [FeatureController::class, 'update'])->name('feature.update');

        Route::get('messages', [MessagesController::class, 'index'])->name('messages.index');
        Route::get('messages/{messages}', [MessagesController::class, 'show'])->name('messages.show');

        Route::get('/mobile-recharge', [MobileRechargeController::class, 'index'])->name('mobile-recharge.index');
        Route::get('/mobile-recharge/{mobileRecharge}', [MobileRechargeController::class, 'show'])->name('mobile-recharge.show');

        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');

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