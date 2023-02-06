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
            "pickup_lat" => "required",
            "pickup_lon" => "required",
            "to_delivery_at" => "nullable",
            "dropup_lat" => "required",
            "dropup_lon" => "required",
        ];
    }
}
