<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
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
        try {
            $emailConfig = EmailConfiguration::first();

            if($emailConfig->email_enable){
                Config::set('mail.mailers.smtp.host', $emailConfig->smtp_host);
                Config::set('mail.mailers.smtp.port', $emailConfig->smtp_port);
                Config::set('mail.mailers.smtp.encryption', $emailConfig->smtp_encryption);
                Config::set('mail.mailers.smtp.username', $emailConfig->smtp_username);
                Config::set('mail.mailers.smtp.password', $emailConfig->smtp_password);
                Config::set('mail.from.address', $emailConfig->from_address);
                Config::set('mail.from.name', $emailConfig->from_name);
            }
            
        } catch (\Exception $e) {
            Log::error('EmailServiceProvider : something went wrong.');
        }
    }
}
