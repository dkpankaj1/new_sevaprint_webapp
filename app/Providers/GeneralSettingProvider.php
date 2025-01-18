<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;

class GeneralSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         // Fetch general settings and share globally
         $settings = GeneralSetting::first();

         if ($settings) {
             config([
                 'app.date_format' => $settings->date_format,
                 'app.timezone' => $settings->timezone,
                 'app.maintenance_mode' => $settings->maintenance_mode,
                 'app.language' => $settings->language,
                 'app.session_timeout' => $settings->session_timeout,
             ]);
 
             // Set application timezone
             if ($settings->timezone) {
                 date_default_timezone_set($settings->timezone);
             }
         }
    }
}
