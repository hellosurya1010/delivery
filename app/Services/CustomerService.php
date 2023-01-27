<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerService extends Service
{

    public static function creareOrUpdate($fields)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->first_name = $fields['first_name'];
            $user->phone = $fields['phone'];
            $user->role = User::$customer;
            if (isset($fields['password'])) {
                $user->password = Hash::make($fields['password']);
            }
            $user->country_id = $fields['country_id'];
            $user->save();
            DB::commit();
        } catch (\Exception $ex) {
            dd($ex);
            DB::rollback();
        }
        return $user;
    }
}
