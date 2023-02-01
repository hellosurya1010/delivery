<?php

namespace App\Http\Requests;

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
            "driving_license_image" => 'nullable|image',
            "driving_license_number" => 'nullable',
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
