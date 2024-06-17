<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=[
            //1
            ['name'=>'Amran Ibrahem',
                'email'=>'amranibrahem@gmail.com',
                'password'=>Hash::make('123456789'),
                'recovery_code'=> mt_rand(5000,500000),
                'role'=>'owner',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //2
            ['name'=>'Mahmoud Ali',
                'email'=>'mahmoud@gmail.com',
                'password'=>Hash::make('123456789'),
                'role'=>'user',
                'recovery_code'=> mt_rand(5000,500000),
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //3
            ['name'=>'Ali Ahmad',
                'email'=>'ali@gmail.com',
                'password'=>Hash::make('123456789'),
                'recovery_code'=> mt_rand(5000,500000),
                'role'=>'user',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //4
            ['name'=>'Roaa',
                'email'=>'roaa@gmail.com',
                'password'=>Hash::make('123456789'),
                'recovery_code'=> mt_rand(5000,500000),
                'role'=>'user',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                'updated_at'=>Carbon::now()->addDays(rand(1, 30))],


        ];

        User::insert($user);
    }
}
