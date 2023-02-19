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
        $admins = [
            [
                'first_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => rand(1000000000, 9999999999),
            ],
            [
                'first_name' => 'Admin',
                'email' => 'surya@admin.com',
                'phone' => rand(1000000000, 9999999999),
            ],
        ];
        foreach ($admins as $admin ) {
            $user = User::where('email', $admin['email'])->orWhere('phone', $admin['phone'])->first();
            if(!$user){
                $user = new User();
                $user->email = $admin['email'];
                $user->phone = $admin['phone'];
                $user->password = Hash::make("12345678");
                $user->role = User::$admin;
                $user->save();
            }
        }
    }
}
