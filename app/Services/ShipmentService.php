<?php

namespace App\Services;

use App\Models\DeliveryPartner;
use App\Models\Shipment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ShipmentService extends Service
{
    public static function makeOrder($user, $fields)
    {
        $shipment = new Shipment();
        $shipment->customer_id = $user->id;
        $shipment->shipment_id = Str::random(6);
        $shipment->to_delivery_at = $fields['to_delivery_at'] ?? Carbon::today()->addDay();
        $shipment->price = $fields['price'];
        $shipment->distance = $fields['distance'];
        $shipment->pickup_lat = $fields['pickup_lat'];
        $shipment->pickup_lon = $fields['pickup_lon'];
        $shipment->dropup_lat = $fields['dropup_lat'];
        $shipment->dropup_lon = $fields['dropup_lon'];
        $shipment->save();  
        return $shipment;
    }



    public static function sendNewShipmentNotification($shipment)
    {
        // $shipment->
    }
    

    public static function assignDeliveryPartner($shipment)
    {
        $shipment->delivery_partner_id = DeliveryPartner::all()->first()->id;
        $shipment->save();
    }

    public function getDeliveryPartners($lat, $lon, $kms)
    {
        $tokos = DeliveryPartner::nearby([$lat, $lon], $kms)->get();
    }

    public static function findShipment($id)
    {
        return Shipment::find($id);
    }
}
