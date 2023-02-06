<?php

namespace Database\Seeders;

use App\Services\DPService;
use Illuminate\Database\Seeder;

class DeliveryPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $partners = [
            [
                "first_name" => "surya",
                "last_name" => "K",
                "email" => "surya.zigainfotech@gmail.com",
                "phone" => "8072122594",
                "password" => "12345678",
                "country_id" => "101",
                "state_id" => "35",
                "city_id" => "3659",
                "driving_license_number" => "SDFGHJK23456",
                "profile_picture" => "SDFGHJK23456",
                "driving_license_image" => "SDFGHJK23456",
            ],
            [
                "first_name" => "alwin",
                "last_name" => "regan",
                "email" => "alwin.zigainfotech@gmail.com",
                "phone" => "8072422594",
                "password" => "12345678",
                "country_id" => "101",
                "state_id" => "35",
                "city_id" => "3659",
                "driving_license_number" => "SDFDFGK23456",
                "profile_picture" => "SDFGHJK23456",
                "driving_license_image" => "SDFGHJK23456",
            ],
            [
                "first_name" => "deepak",
                "last_name" => "kishore",
                "email" => "deepak.zigainfotech@gmail.com",
                "phone" => "8012422594",
                "password" => "12345678",
                "country_id" => "101",
                "state_id" => "35",
                "city_id" => "3659",
                "driving_license_number" => "SDDFGK23456",
                "profile_picture" => "SDFGHK23456",
                "driving_license_image" => "SDFGHJK23456",
            ],
            [
                "first_name" => "Hari",
                "last_name" => "",
                "email" => "Hari.zigainfotech@gmail.com",
                "phone" => "8072422592",
                "password" => "12345678",
                "country_id" => "101",
                "state_id" => "35",
                "city_id" => "3659",
                "driving_license_number" => "SDFDFGK23456",
                "profile_picture" => "SDFGHJK23456",
                "driving_license_image" => "SDFGHJK23456",
            ],
        ];

        foreach ($partners as $partner) {
            DPService::createOrUpdatePartner($partner);
        }
    }
}
