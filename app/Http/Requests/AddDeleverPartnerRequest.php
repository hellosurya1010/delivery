<?php

namespace App\Http\Requests;

use App\Models\DeliveryPartner;
use Illuminate\Foundation\Http\FormRequest;

class AddDeleverPartnerRequest extends FormRequest
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
        $dv = new DeliveryPartner();
        // $dv::$approved 
        // $dv::$approved
        // $dv::$rejected 
        // $dv::$inActive 
        // $dv::$active
        // $dv::$inActive
        return [
            "country_id" => 'required|exists:countries,id|numeric',
            "state_id" => 'required|exists:states,id|numeric',
            "city_id" => 'required|exists:cities,id|numeric',
            "first_name" => 'required',
            "last_name" => 'required',
            "email" => 'required|email|unique:users,email',
            "phone" => 'required|numeric|unique:users,phone',
            "password" => 'required',
            "profile_picture" => 'required|image',
            "driving_license_image" => 'required|image',
            "driving_license_number" => 'required',
            "is_approved" => "nullable",
            "is_active" => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'country',
            'state_id' => 'state',
            'city_id' => 'city',
        ];
    }
}
