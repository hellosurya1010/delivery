<?php

namespace Database\Seeders;

use App\Services\CustomerService;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                "first_name" => "Shobi",
                "phone" => "8070120592",
                "password" => "12345678",
                "country_id" => "101",
            ],
            [
                "first_name" => "Priya",
                "phone" => "8072122591",
                "password" => "12345678",
                "country_id" => "101",
            ],
            [
                "first_name" => "Keke",
                "phone" => "8070122592",
                "password" => "12345678",
                "country_id" => "101",
            ],
        ];

        foreach ($customers as $customer) {
            CustomerService::creareOrUpdate($customer);
        }
    }
}
