<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'name' => 'United States Dollar', 'symbol' => '$', 'exchange_rate' => 1.00, 'is_active' => true],
            ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹', 'exchange_rate' => 74.00, 'is_active' => true],
        ];

        DB::table('currencies')->insert($currencies);
    }
}
