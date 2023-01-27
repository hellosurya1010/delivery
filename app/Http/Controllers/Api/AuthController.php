<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDeleverPartnerRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Models\User;
use App\Services\CustomerService;
use App\Services\DPService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkExists(Request $request, $slug)
    {
        $exists = false;
        if ($slug == "email") {
            $exists = User::where('email', $request->email)->first() ? false : true;
        }
        // return (new ResponseService)->data(['cities' => $states])->getResponse();
        return (new ResponseService)->data(["is_$slug"."_exists" => $exists])->getResponse();
    }

    public function addDeleverPartner(AddDeleverPartnerRequest $request)    
    {
        $partner = DPService::createOrUpdatePartner($request->validated());
        return (new ResponseService)->data(["delivery_partner" =>  $partner])->getResponse();
    }
    public function addCustomerPartner(CreateCustomerRequest $request)    
    {
        $customer = CustomerService::creareOrUpdate($request->validated());
        return (new ResponseService)->data(["customer" =>  $customer])->getResponse();
    }

}
