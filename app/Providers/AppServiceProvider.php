<?php

namespace App\Providers;

use App\Features\MobileRechargeFeature;
use App\Features\NsdlPanFeature;
use App\Models\BrandSetting;
use App\Models\EmailConfiguration;
use App\Models\Feature;
use App\Models\GeneralSetting;
use App\Models\Service;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerBladeDirective();
        $this->registerGates();
        $this->registerViewShare();
    }
    public function registerGates()
    {

        Gate::define('checkBalance', function ($user, $amount) {
            return $user->wallet >= $amount;
        });
    }

    public function registerBladeDirective()
    {
        Blade::if('featureMobileRechargeEnabled', function () {
            return MobileRechargeFeature::isEnabled();
        });

        Blade::if('nsdlPanFeatureEnabled', function () {
            return NsdlPanFeature::isEnabled();
        });
    }

    public function registerViewShare()
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
