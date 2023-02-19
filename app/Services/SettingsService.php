<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService extends Service{

    public static function shipment()
    {
        return self::setting('shipment');
    }

    public static function map()
    {
        return self::setting('map');
    }

    public static function setting($name)
    {
        return Setting::where('name', $name)->first();   
    }


}