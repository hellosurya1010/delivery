<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $settings = [
            "shipment" => [
                "price_per_miles" => "100",
                "price_per_kilometer" => "100",
                "currency_id" => "1"
            ],
            "map" =>  [
                "key" => ""
            ], 
        ];
        foreach($settings as $name => $data){
            if(!Setting::where('name', $name)->first()){
                $setting = new Setting();
                $setting->name = $name;
                $setting->data = $data;
                $setting->save();
            }
        }
    }
}
