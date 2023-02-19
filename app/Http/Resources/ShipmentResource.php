<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "shipment_id" => $this->shipment_id,
            "customer_id" => $this->customer_id,
            "delivery_partner_id" => $this->delivery_partner_id,
            "to_delivery_at" => $this->to_delivery_at,
            "price" => $this->price,
            "distance" => $this->distance,
            "status" => $this->status,
            "pickup_lat" => $this->pickup_lat,
            "pickup_lon" => $this->pickup_lon,
            "pickup_place_id" => $this->pickup_place_id,
            "pickup_place_name" => $this->pickup_place_name,
            "dropin_lat" => $this->dropin_lat,
            "dropin_lon" => $this->dropin_lon,
            "dropin_place_id" => $this->dropin_place_id,
            "dropin_place_name" => $this->dropin_place_name,
            "created_at" => $this->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
