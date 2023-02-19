<?php

namespace App\Http\Resources;

use App\Services\CSCService;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentSettingResource extends JsonResource
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
        $data = [
            'price_per_kilometer' => $this->data["price_per_kilometer"],
            'price_per_miles' => $this->data["price_per_miles"],
            'currency' => new CurrencyResource(CSCService::findCurreny($this->data["currency_id"])),
        ];
        return $data;
    }
}
