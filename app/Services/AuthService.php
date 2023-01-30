<?php

namespace App\Services;

class AuthService extends Service
{
    public static function updateCoOridinates($user, $fileds)
    {
        $user->latitude = $fileds['latitude'];
        $user->longitude = $fileds['longitude'];
        $user->save();
        return $user;
    }
    public static function updateDeviceToken($user, $fileds)
    {
        $user->device_token = $fileds['device_token'];
        $user->save();
        return $user;
    }
}
