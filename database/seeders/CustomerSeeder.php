<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'customer')->first();

        Customer::updateOrCreate(
            ['id_user' => $user->id_user],
            [
                'nama' => 'Customer PetCare',
                'email' => 'customer@petcare.test',
                'no_hp' => '081234567890',
                'alamat' => 'Semarang, Jawa Tengah',
            ]
        );
    }
}