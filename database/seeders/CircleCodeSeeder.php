<?php

namespace Database\Seeders;

use App\Models\CircleCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CircleCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "code" => "10",
                "plan_api_code" => 10,
                "name" => "DELHI",
            ],
            [
                "code" => "97",
                "plan_api_code" => 97,
                "name" => "UP(West)",
            ],
            [
                "code" => "02",
                "plan_api_code" => 02,
                "name" => "PUNJAB",
            ],
            [
                "code" => "03",
                "plan_api_code" => 03,
                "name" => "HP",
            ],
            [
                "code" => "96",
                "plan_api_code" => 96,
                "name" => "HARYANA",
            ],
            [
                "code" => "55",
                "plan_api_code" => 55,
                "name" => "J&K",
            ],
            [
                "code" => "54",
                "plan_api_code" => 54,
                "name" => "UP(East)",
            ],
            [
                "code" => "92",
                "plan_api_code" => 92,
                "name" => "MUMBAI",
            ],
            [
                "code" => "90",
                "plan_api_code" => 90,
                "name" => "MAHARASHTRA",
            ],
            [
                "code" => "98",
                "plan_api_code" => 98,
                "name" => "GUJARAT",
            ],
            [
                "code" => "93",
                "plan_api_code" => 93,
                "name" => "MP",
            ],
            [
                "code" => "70",
                "plan_api_code" => 70,
                "name" => "RAJASTHAN",
            ],
            [
                "code" => "31",
                "plan_api_code" => 31,
                "name" => "KOLKATTA",
            ],
            [
                "code" => "51",
                "plan_api_code" => 51,
                "name" => "West Bengal",
            ],
            [
                "code" => "53",
                "plan_api_code" => 53,
                "name" => "ORISSA",
            ],
            [
                "code" => "56",
                "plan_api_code" => 56,
                "name" => "ASSAM",
            ],
            [
                "code" => "16",
                "plan_api_code" => 16,
                "name" => "NESA",
            ],
            [
                "code" => "52",
                "plan_api_code" => 52,
                "name" => "BIHAR",
            ],
            [
                "code" => "06",
                "plan_api_code" => 06,
                "name" => "KARNATAKA",
            ],
            [
                "code" => "40",
                "plan_api_code" => 40,
                "name" => "CHENNAI",
            ],
            [
                "code" => "94",
                "plan_api_code" => 94,
                "name" => "TAMIL NADU",
            ],
            [
                "code" => "95",
                "plan_api_code" => 95,
                "name" => "KERALA",
            ],
            [
                "code" => "49",
                "plan_api_code" => 49,
                "name" => "AP",
            ],
        ];


        CircleCode::insert($data);
    }
}
