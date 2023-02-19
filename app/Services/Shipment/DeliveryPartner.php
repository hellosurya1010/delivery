<?php

namespace App\Services\Shipment;

use App\Models\Shipment;

class DeliveryPartner extends Service
{
    public static function unAccepted($user)
    {
        return Shipment::where('status', Shipment::$statusOrderPlaced)->get();
    }

    public static function getByStatus($user, $status)
    {
        return Shipment::where('status', $status)
        ->where('delivery_partner_id', $user->id)
        ->get();
    }

    public static function all($user)
    {
        return Shipment::where('delivery_partner_id', $user->id)->get();
    }

}
