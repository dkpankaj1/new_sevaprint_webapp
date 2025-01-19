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
                'commission'=>0,
                'commission_type'=>0, //fixed = 0;percent = 1
                'enable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FTR002',
                'name' => 'NSDL Pan',
                'description' => 'Apply for a PAN card, track status, change or correct details, reprint, and know required documents. Get PAN Services.',
                'fee' => 150.00,
                'commission'=>0,
                'commission_type'=>0, //fixed = 0;percent = 1
                'enable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
