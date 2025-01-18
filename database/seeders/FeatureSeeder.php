<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'code' => 'FTR001',
                'name' => 'Mobile Recharge',
                'description' => 'Mobile recharge service.',
                'fee' => 0.00,
                'enable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FTR002',
                'name' => 'NSDL Pan',
                'description' => 'Apply for a PAN card, track status, change or correct details, reprint, and know required documents. Get PAN Services.',
                'fee' => 800.00,
                'enable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'code' => 'FTR003',
            //     'name' => 'SEO Optimization',
            //     'description' => 'Optimize your website for better search engine rankings.',
            //     'fee' => 1200.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR004',
            //     'name' => 'Content Writing',
            //     'description' => 'High-quality content writing services for blogs and websites.',
            //     'fee' => 500.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR005',
            //     'name' => 'Digital Marketing',
            //     'description' => 'Comprehensive digital marketing campaigns for your business.',
            //     'fee' => 2000.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR006',
            //     'name' => 'Mobile App Development',
            //     'description' => 'Custom mobile app development for iOS and Android.',
            //     'fee' => 3000.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR007',
            //     'name' => 'Cloud Hosting',
            //     'description' => 'Reliable cloud hosting solutions for your business.',
            //     'fee' => 400.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR008',
            //     'name' => 'IT Support',
            //     'description' => '24/7 IT support to keep your business running smoothly.',
            //     'fee' => 1000.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR009',
            //     'name' => 'Video Editing',
            //     'description' => 'Professional video editing services for all types of media.',
            //     'fee' => 600.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'code' => 'FTR010',
            //     'name' => 'Cybersecurity',
            //     'description' => 'Protect your business from cyber threats with our services.',
            //     'fee' => 2500.00,
            //     'enable' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
