<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public static $statusOrderPlaced = "OrderPlaced";
    public static $statusAccepted = "OrderAccepted";
    public static $statusDelivered = "OrderDelivered";
    use HasFactory;

    public function statues()
    {
        return $this->hasMany(ShipmentStatus::class);
    }

    public function deliveryPartner(){
        return $this->belongsTo(User::class, "delivery_partner_id");
    }

    public function customer(){
        return $this->belongsTo(User::class, "customer_id");
    }

}
