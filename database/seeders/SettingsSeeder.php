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
        $settings = [
            "shipment" => [
                "price" => "100",
                "distance_unit" => "mile",
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
