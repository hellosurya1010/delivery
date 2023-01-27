<?php

namespace App\Services;

use App\Models\College;
use App\Models\Course;
use App\Models\DeliveryPartner;
use App\Models\Department;
use App\Models\User;
use App\Models\UserCollege;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DPService extends Service
{

    public static function createOrUpdatePartner($fields)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->first_name = $fields['first_name'];
            $user->last_name = $fields['last_name'];
            $user->email = $fields['email'];
            $user->phone = $fields['phone'];
            $user->role = User::$deliveryPartner;
            if (isset($fields['password'])) {
                $user->password = Hash::make($fields['password']);
            }
            $user->country_id = $fields['country_id'];
            $user->state_id = $fields['state_id'];
            $user->city_id = $fields['city_id'];
            $user->save();
            $dv = $user->deliveryPartner;
            if (!$dv) {
                $dv = new DeliveryPartner();
            }
            $dv->user_id = $user->id;
            $dv->driving_license_number = $fields['driving_license_number'];
            if (is_file($fields['driving_license_image'])) $dv->driving_license_image = Service::storeInPublic('driving_license_image', $fields['driving_license_image']);
            if (is_file($fields['profile_picture'])) $dv->profile_picture = Service::storeInPublic('profile_picture', $fields['driving_license_image']);
            $dv->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
        }
        return $user;
    }
}
