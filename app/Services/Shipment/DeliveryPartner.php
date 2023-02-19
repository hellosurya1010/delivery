<?php

namespace App\Services\Shipment;

use App\Models\Shipment;

class DeliveryPartner extends Service
{
    public static function unAccepted($user)
    {
        return Shipment::where('status', Shipment::$statusOrderPlaced)->get();
    }

    
}
