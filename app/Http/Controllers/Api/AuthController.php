<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDeleverPartnerRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\CustomerService;
use App\Services\DPService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public $errors = false;
    public $message = 'Successfull';
    public $code = 200;
    public $exists = true;

    public function checkExists(Request $request, $slug)
    {
        $exists = false;
        if ($slug == "email") {
            $exists = User::where('email', $request->email)->first() ? false : true;
        }
        // return (new ResponseService)->data(['cities' => $states])->getResponse();
        return (new ResponseService)->data(["is_$slug" . "_exists" => $exists])->getResponse();
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

    public function register(Request $request, User $user, $slug)
    {

        if ($slug == 'user') {
            $validated = $request->validate([
                'profile_picture' => 'nullable|image',
                'name' => 'required',
                'role' => 'required|in:Doctor,Patient',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required',
                'consultation_fees' => 'nullable',
                'medicine_type_id' => 'nullable',
            ]);
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            if ($request->hasFile('profile_picture')) {
                $user->profile_pic = $this->storeImage($request->file('profile_picture'), 'profile_picture');
                $validated['profile_picture'] = $user->profile_pic;
            }
            $user->save();
        }

        $token = $user->createToken('tokens')->plainTextToken;
        unset($validated['password']);
        $validated['unique_id'] = $user->unique_id;
        return response()->json(['message' => 'Registeded Successfully', 'data' => $validated, 'token' => $token], 201);
    }


    public function login(Request $request)
    {
        $request->validate(['phone' => 'required', 'password' => 'required']);
        $user = User::where('phone', $request->phone)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return (new ResponseService)->message('Wrong password')->code(500)->errors(true)->getResponse();
        }
        $token = $user->createToken('tokens')->plainTextToken;
        Auth::login($user);
        return (new ResponseService)
            ->message('Logined Successfully')
            ->data([
                'token' => $token,
                'user_details' => $user
            ])->getResponse();
    }


    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout Successfully'], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['phone' => 'required', 'password' => 'required|min:8']);
        try {
            $user = User::where('phone', $request->phone)->first();
            $user->update(['password' => Hash::make($request->password)]);
            $this->message = "Password changed successfully";
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Server error', 'error' => true], 200);
        }
        return response()->json(['message' => $this->message, 'error' => $this->errors], $this->code);
    }

    public function changeChredentials(Request $request, $slug, $requestFor)
    {

        if ($requestFor == "mobile-number") {
            $request->validate(["phone" => "required|unique:users,phone," . auth()->id() . ",id"]);
            try {
                User::where('id', auth()->id())->update(['phone' => $request->phone]);
                $this->message = "Mobile number changed successfully";
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Server error', 'error' => true], 200);
            }
        }


        if ($requestFor == "password") {
            $request->validate(['old_password' => 'required', 'new_password' => 'required|min:8']);
            $user = User::find(auth()->id());
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => Hash::make($request->new_password)]);
            } else {
                $this->message = "Password dosen't match";
                $this->errors = true;
            }
        }

        return response()->json(['message' => $this->message, 'error' => $this->errors], $this->code);
    }

    public function checkChredentials(Request $request, $slug, $requestFor)
    {

        if ($requestFor == 'mobile-number') {
            $request->validate(['phone' => 'required']);
            $user = User::where('phone', $request->phone)->first();
            if ($user) {
                $this->message = 'Mobile number already exists';
            } else {
                $this->message = "Mobile number  dosen't exists";
                $this->errors = true;
                $this->exists = false;
            }
        }

        if ($requestFor == 'password') {
            $request->validate(['password' => 'required']);
            if (Hash::check($request->password, auth()->user()->password)) {
                $this->message = "Password matche";
            } else {
                $this->message = "Password dosen't match";
                $this->errors = true;
                $this->exists = false;
            }
        }

        return response()->json(['message' => $this->message, 'exists' => $this->exists, 'error' => $this->errors], $this->code);
    }

    public function checkPassword(Request $request, $slug)
    {
        $request->validate(['password' => 'required']);
        if (Hash::check($request->password, auth()->user()->password)) {
            $this->message = "Password matche";
        } else {
            $this->message = "Password dosen't match";
            $this->errors = true;
            $this->exists = false;
        }
        return response()->json(['message' => $this->message, 'exists' => $this->exists, 'error' => $this->errors], $this->code);
    }

    public function updateDeviceToken(Request $request)
    {
        $validated = $request->validate(['device_token' => 'required']);
        AuthService::updateDeviceToken(auth()->user(), $validated);
        return (new ResponseService)->message('Co-ordinates updated successfully.')->getResponse();
    }

    public function updateCoOrdinates(Request $request)
    {
        $validated = $request->validate(['latitude' => "required", "longitude" => 'required']);
        AuthService::updateCoOridinates(auth()->user(), $validated);
        return (new ResponseService)->message('Co-ordinates updated successfully.')->getResponse();
    }
}
