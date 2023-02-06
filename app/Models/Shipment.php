<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public static $statusOrderPlace = "OrderPlaced";
    public static $statusAccepted = "OrderAccepted";
    public static $statusDelivered = "OrderDelivered";
    use HasFactory;
}
