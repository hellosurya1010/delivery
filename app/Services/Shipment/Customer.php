<?php

namespace App\Services\Shipment;

use App\Models\Shipment;

class Customer extends Service
{
    public static function getByStatus($user, $status)
    {
        return Shipment::where('status', $status)
        ->where('customer_id', $user->id)
        ->get();
    }

    public static function all($user)
    {
        return Shipment::where('customer_id', $user->id)->get();
    }
}
