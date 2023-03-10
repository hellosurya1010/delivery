<?php

namespace App\Models;

use Bagusindrayana\LaravelCoordinate\Traits\LaravelCoordinate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPartner extends Model
{
    use HasFactory, LaravelCoordinate;
    public $_latitudeName = "latitude_column"; 
    public $_longitudeName = "longitude_column"; 
    public static $approved = "Approved";
    public static $rejected = "Rejected";
    public static $active = "Active";
    public static $onReview = "OnReview";
    public static $inActive = "InActive";

    public function scopeAllActive($query)
    {
        return $query->where('is_live', 1)->where('is_active', 1)->where('is_approved', 1);
    }
}
