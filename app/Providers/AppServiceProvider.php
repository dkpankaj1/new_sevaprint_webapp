<?php

namespace App\Providers;

use App\Models\BrandSetting;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $brandSetting = BrandSetting::first();
            $generalSetting = GeneralSetting::first();
            $emailConfig = EmailConfiguration::first();

            if ($brandSetting) {
                View::share('brandSetting', $brandSetting);
            }

            if ($generalSetting) {
                View::share('generalSetting', $generalSetting);
            }

            if ($emailConfig) {
                View::share('emailConfigurationSetting', $emailConfig);
            }
        } catch (\Throwable $th) {
            Log::error('Error sharing settings in views', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
        }
    }
}
