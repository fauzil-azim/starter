<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        // $password = 'password';
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password_1  = substr($random, 0, 10);
        $password_2  = substr($random, 0, 10);
        $password_3  = substr($random, 0, 10);
        $password_4  = substr($random, 0, 10);

        $seeds = [
            [
                [
                    'email'             => 'fauzil@gmail.com',
                ],
                [
                    'name'              => 'fauzil',
                    'email_verified_at' => $now,
                    'password'          => $password_1
                ]
            ],
            [
                [
                    'email'             => 'rais@gmail.com',
                ],
                [
                    'name'              => 'rais',
                    'email_verified_at' => $now,
                    'password'          => $password_2
                ]
            ],
            [
                [
                    'email'             => 'yamin@gmail.com',
                ],
                [
                    'name'              => 'yamin',
                    'email_verified_at' => $now,
                    'password'          => $password_3
                ]
            ],
            [
                [
                    'email'             => 'aldo@gmail.com',
                ],
                [
                    'name'              => 'aldo',
                    'email_verified_at' => $now,
                    'password'          => $password_4
                ]
            ],
         ];

         foreach($seeds as $key => $value) {
             $user = User::updateOrCreate($value[0],$value[1]);
             $password = ${"password" . "_" . ($key + 1)};
             $user->encrypted()->updateOrCreate(['encrypted_password' => Crypt::encrypt($password)]);
         }
    }
}
