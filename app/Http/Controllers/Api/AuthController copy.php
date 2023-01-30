<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public $errors = false;
    public $message = 'Successfull';
    public $code = 200;
    public $exists = true;

    public function register(Request $request, User $user, $slug)
    {

        if ($slug == 'user') {
            $validated = $request->validate([
                'profile_picture' => 'nullable|image',
                'name' => 'required',
                'role' => 'required|in:Doctor,Patient',
                'email' => 'required|email|unique:users,email',
                'mobile_number' => 'required|unique:users,phone',
                'password' => 'required',
                'consultation_fees' => 'nullable',
                'medicine_type_id' => 'nullable',
            ]);
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->mobile_number;
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
        $request->validate(['mobile_number' => 'required|min:10']);

        $user = User::where('phone', $request->mobile_number)->first();
        if (!isset($request->password)) {
            return response()->json(['messsage' =>  "Mobile number dosen't exists!", 'errors' => true]);
        }

        $request->validate(['mobile_number' => 'required', 'password' => 'required']);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['messsage' =>  "Wrong password", 'errors' => true]);
        }

        $user_details = $user->toArray();
        $user_details['profile_picture']  = $user_details['profile_pic'];
        $user_details['mobile_number']  = $user_details['phone'];
        unset($user_details['profile_pic']);
        unset($user_details['phone']);

        if ($user->role == 'Patient' && $user->patient != null) {
            $user_details += $user->patient->toArray();
        }

        if ($user->role == 'Doctor' && $user->doctor_details != null) {
            $user_details += $user->doctor_details->toArray();
        }
        if ($user->role == 'HA' && $user->doctor_details != null) {
            $user_details += $user->doctor_details->toArray();
        }
        $token = $user->createToken('tokens')->plainTextToken;

        Auth::login($user);
        return response()->json(['message' => 'Logined Successfully', 'user_details' => $user_details, 'errors' => false, 'token' => $token], 200);
    }


    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout Successfully'], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['mobile_number' => 'required|min:10', 'password' => 'required|min:8']);
        try {
            $user = User::where('phone', $request->mobile_number)->first();
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
            $request->validate(["mobile_number" => "required|min:10|unique:users,phone," . auth()->id() . ",id"]);
            try {
                User::where('id', auth()->id())->update(['phone' => $request->mobile_number]);
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
            $request->validate(['mobile_number' => 'required|min:10']);
            $user = User::where('phone', $request->mobile_number)->first();
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

    public function updateDeviceToken(Request $request, $slug)
    {
        $request->validate(['device_token' => 'required']);
        if ($slug == 'android') {
            auth()->user()->update(['android_key' => $request->device_token]);
        }
        return response()->json(['message' => $this->message, 'error' => $this->errors], $this->code);
    }
}
