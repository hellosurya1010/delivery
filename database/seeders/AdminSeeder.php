<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = "Admin";
        $user->email = "admin@gmail.com";
        $user->phone = "1234567890";
        $user->password = Hash::make("12345678");
        $user->role = User::$admin;
        $user->save();
    }
}
