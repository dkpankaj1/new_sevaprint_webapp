<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NicePeConfiguration;
use App\Models\PhonePeConfiguration;
use App\Models\RazorPayConfiguration;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed NicePeConfiguration
        NicePeConfiguration::create([
            'name' => 'NicePe',
            'description' => 'NicePe payment gateway integration',
            'logo' => 'nicepe_logo.png',
            'api_key' => 'nicepe_api_key_123',
            'secret_key' => 'nicepe_secret_key_123',
            'enable' => true,
        ]);

        // Seed PhonePeConfiguration
        PhonePeConfiguration::create([
            'name' => 'PhonePe',
            'description' => 'PhonePe payment gateway integration',
            'logo' => 'phonepe_logo.png',
            'merchant_id' => 'phonepe_merchant_123',
            'salt_key' => 'phonepe_salt_key_123',
            'salt_index' => '1',
            'enable' => true,
        ]);

        // Seed RazorPayConfiguration
        RazorPayConfiguration::create([
            'name' => 'RazorPay',
            'description' => 'RazorPay payment gateway integration',
            'logo' => 'razorpay_logo.png',
            'api_key' => 'razorpay_api_key_123',
            'api_secret' => 'razorpay_secret_key_123',
            'webhook_secret' => 'razorpay_webhook_secret_123',
            'enable' => true,
        ]);
    }
}
