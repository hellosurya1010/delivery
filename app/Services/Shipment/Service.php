<?php

namespace App\Services\Shipment;

use App\Models\DeliveryPartner;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use App\Models\User;
use App\Services\Service as ServicesService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Service extends ServicesService
{
    public static function makeShipment($user, $fields)
    {
        try {
            $shipment = new Shipment();
            $shipment->customer_id = $user->id;
            $shipment->shipment_id = Str::random(6);
            $shipment->to_delivery_at = $fields['to_delivery_at'] ?? Carbon::today()->addDay();
            $shipment->price = $fields['price'];
            $shipment->distance = $fields['distance'];
            
            $shipment->pickup_lat = $fields['pickup_lat'];
            $shipment->pickup_lon = $fields['pickup_lon'];
            $shipment->pickup_place_id = $fields['pickup_place_id'];
            $shipment->pickup_place_name = $fields['pickup_place_name'];

            $shipment->dropin_lat = $fields['dropin_lat'];
            $shipment->dropin_lon = $fields['dropin_lon'];
            $shipment->dropin_place_id = $fields['dropin_place_id'];
            $shipment->dropin_place_name = $fields['dropin_place_name'];
            $shipment->save();
            $shipment->status = Shipment::$statusOrderPlaced;
            $shipment->save();
            self::logStatus($shipment, $user);
        } catch (\Throwable $th) {
            self::debugException($th);
        }
        return $shipment;
    }

    public static function findShipment($id)
    {
        return Shipment::find($id);
    }

    public static function getShipmentStatues($id)
    {
        return ShipmentStatus::where('shipment_id',$id)->get();
    }

    

    public static function logStatus($shipment, $user)
    {
        try {
            $shipmentStatus = new ShipmentStatus();
            $shipmentStatus->shipment_id = $shipment->id;
            $shipmentStatus->status = $shipment->status;
            $shipmentStatus->updated_by = $user->role;
            $shipmentStatus->save();
            return $shipmentStatus;
        } catch (\Throwable $th) {
            self::debugException($th);
        }
    }
}
