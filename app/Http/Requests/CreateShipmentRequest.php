<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "price" => "required",
            "distance" => "required",
            "to_delivery_at" => "nullable",
            
            "pickup_lat" => "required",
            "pickup_lon" => "required",
            "pickup_place_id" => "required",
            "pickup_place_name" => "required",
            
            "dropin_lat" => "required",
            "dropin_lon" => "required",
            "dropin_place_id" => "required",
            "dropin_place_name" => "required",
            
        ];
    }
}
