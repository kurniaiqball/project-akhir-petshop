<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@petcare.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'customer'],
            [
                'name' => 'Customer PetCare',
                'email' => 'customer@petcare.test',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
            ]
        );
    }
}