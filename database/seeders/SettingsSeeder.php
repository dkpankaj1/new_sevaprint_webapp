<?php

namespace Database\Seeders;

use App\Models\BrandSetting;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed BrandSetting
        BrandSetting::create([
            "name" => "Kadso",
            "title" => "Kadso Title",
            "description" => "Kadso description",
            "logo" => "",
            "logo_main" => "",
            "favicon" => "",
            "contact_email" => "info@kadso.com",
            "contact_phone" => "+1234567890",
        ]);

        // Seed GeneralSetting
        GeneralSetting::create([
            "date_format" => "Y-m-d",
            "default_currency" => 1,
            "timezone" => "UTC",
            "maintenance_mode" => false,
            "language" => "en",
            "session_timeout" => 30, // in minutes
            "copyright" => "© 2024 Kadso",
            "developed_by" => "Kadso Tech",
        ]);

        // Seed EmailConfiguration
        EmailConfiguration::create([
            "email_enable" => true,
            "smtp_host" => "smtp.kadso.com",
            "smtp_port" => 587,
            "smtp_username" => "smtp_user@kadso.com",
            "smtp_password" => "securepassword",
            "smtp_encryption" => "tls",
            "from_address" => "noreply@kadso.com",
            "from_name" => "Kadso Support",
            "reply_to_address" => "support@kadso.com",
            "reply_to_name" => "Kadso Helpdesk",
        ]);
    }
}
