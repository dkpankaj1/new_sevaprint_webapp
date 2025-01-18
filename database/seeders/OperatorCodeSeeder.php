<?php

namespace Database\Seeders;

use App\Models\OperatorCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorCodeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                "code" => "AT",
                "plan_api_code" => "2",
                "name" => "AIRTEL",
                "type" => "mobile",
            ],
            [
                "code" => "VI",
                "plan_api_code" => "23",
                "name" => "VODAFONE IDEA",
                "type" => "mobile",
            ],
            [
                "code" => "SD",
                "plan_api_code" => null,
                "name" => "SUN TV",
                "type" => "dth",
            ],
            [
                "code" => "BS",
                "plan_api_code" => "5",
                "name" => "BSNL",
                "type" => "mobile",
            ],
            [
                "code" => "AD",
                "plan_api_code" => "24",
                "name" => "AIRTEL DTH",
                "type" => "dth",
            ],
            [
                "code" => "DT",
                "plan_api_code" => "25",
                "name" => "DISH TV",
                "type" => "dth",
            ],
            [
                "code" => "TS",
                "plan_api_code" => "28",
                "name" => "TATASKY",
                "type" => "dth",
            ],
            [
                "code" => "VD",
                "plan_api_code" => "29",
                "name" => "VIDEOCON",
                "type" => "dth",
            ],
            [
                "code" => "JL",
                "plan_api_code" => "11",
                "name" => "JIO",
                "type" => "mobile",
            ],
            [
                "code" => "AM",
                "plan_api_code" => null,
                "name" => "AIRTEL MONEY",
                "type" => "mobile",
            ],
        ];

        OperatorCode::insert($data);
    }
}
