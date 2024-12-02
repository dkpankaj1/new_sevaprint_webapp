<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert countries
        $countries = [
            ['name' => 'India', 'code' => 'IND', 'currency_code' => 'INR'],
        ];

        DB::table('countries')->insert($countries);

        // Get country IDs
        $countryIds = DB::table('countries')->pluck('id', 'code');

        // Insert states
        $states = [
            // States for India
            ['name' => 'Andhra Pradesh', 'country_id' => $countryIds['IND']],
            ['name' => 'Arunachal Pradesh', 'country_id' => $countryIds['IND']],
            ['name' => 'Assam', 'country_id' => $countryIds['IND']],
            ['name' => 'Bihar', 'country_id' => $countryIds['IND']],
            ['name' => 'Chhattisgarh', 'country_id' => $countryIds['IND']],
            ['name' => 'Goa', 'country_id' => $countryIds['IND']],
            ['name' => 'Gujarat', 'country_id' => $countryIds['IND']],
            ['name' => 'Haryana', 'country_id' => $countryIds['IND']],
            ['name' => 'Himachal Pradesh', 'country_id' => $countryIds['IND']],
            ['name' => 'Jharkhand', 'country_id' => $countryIds['IND']],
            ['name' => 'Karnataka', 'country_id' => $countryIds['IND']],
            ['name' => 'Kerala', 'country_id' => $countryIds['IND']],
            ['name' => 'Madhya Pradesh', 'country_id' => $countryIds['IND']],
            ['name' => 'Maharashtra', 'country_id' => $countryIds['IND']],
            ['name' => 'Manipur', 'country_id' => $countryIds['IND']],
            ['name' => 'Meghalaya', 'country_id' => $countryIds['IND']],
            ['name' => 'Mizoram', 'country_id' => $countryIds['IND']],
            ['name' => 'Nagaland', 'country_id' => $countryIds['IND']],
            ['name' => 'Odisha', 'country_id' => $countryIds['IND']],
            ['name' => 'Punjab', 'country_id' => $countryIds['IND']],
            ['name' => 'Rajasthan', 'country_id' => $countryIds['IND']],
            ['name' => 'Sikkim', 'country_id' => $countryIds['IND']],
            ['name' => 'Tamil Nadu', 'country_id' => $countryIds['IND']],
            ['name' => 'Telangana', 'country_id' => $countryIds['IND']],
            ['name' => 'Uttar Pradesh', 'country_id' => $countryIds['IND']],
            ['name' => 'Uttarakhand', 'country_id' => $countryIds['IND']],
            ['name' => 'West Bengal', 'country_id' => $countryIds['IND']],
        ];

        DB::table('states')->insert($states);

    }
}
