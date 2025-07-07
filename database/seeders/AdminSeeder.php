<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone' => '+1234567890',
            'password' => Hash::make('admin123'),
            'user_type' => UserType::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        //sample client users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'phone' => '+1234567891',
            'password' => Hash::make('client123'),
            'user_type' => UserType::CLIENT,
            'status' => UserStatus::ACTIVE,
        ]);

        User::create([
            'name' => 'Joe',
            'email' => 'joe@gmail.com',
            'phone' => '+1234567892',
            'password' => Hash::make('12345678'),
            'user_type' => UserType::CLIENT,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}