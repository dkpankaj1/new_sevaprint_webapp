<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountryStateSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(OperatorCodeSeeder::class);
        $this->call(CircleCodeSeeder::class);
        $this->call(AboutUsSeeder::class);

        User::create([
            'name' => "user",
            'email' => "user@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'wallet' => 1000,
            'is_active' => 1
        ]);

        Admin::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('123456'),
        ]);

    }
}
