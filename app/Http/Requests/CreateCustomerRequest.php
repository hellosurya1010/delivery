<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            "phone_code" => 'required|exists:countries,phonecode',
            "first_name" => 'required',
            "phone" => 'required|numeric|unique:users,phone',
            "password" => 'required',
            "country_id" => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        $country = Country::where('phonecode', $this->phone_code)->first();
        $countryId = isset($country) ? $country->id : 0;
        $this->merge([
            'country_id' => $countryId,
        ]);
    }
}
