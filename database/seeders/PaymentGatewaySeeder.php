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
            'name' => 'nicepe',
            'description' => 'NicePe payment gateway integration',
            'upi_id' => 'paytmqr281005050101mnp7fhqey7n0@paytm',
            'token' => 'a8f156-c687de-f6a2eb-09dac9-984cf2',
            'secret_key' => 'lpVnf2pnVJ',
            'base_url' => 'https://pg.allnice.in/order/paytm',
            'enable' => true,
        ]);

        // Seed PhonePeConfiguration
        PhonePeConfiguration::create([
            'name' => 'phonepe',
            'description' => 'PhonePe payment gateway integration',
            'merchant_id' => 'phonepe_merchant_123',
            'salt_key' => 'phonepe_salt_key_123',
            'salt_index' => '1',
            'enable' => false,
        ]);

        // Seed RazorPayConfiguration
        RazorPayConfiguration::create([
            'name' => 'razorpey',
            'description' => 'RazorPay payment gateway integration',
            'api_key' => 'razorpay_api_key_123',
            'api_secret' => 'razorpay_secret_key_123',
            'webhook_secret' => 'razorpay_webhook_secret_123',
            'enable' => false,
        ]);
    }
}
