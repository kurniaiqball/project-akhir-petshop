<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::updateOrCreate(
            ['nama_service' => 'Basic Grooming'],
            [
                'harga' => 50000,
                'durasi' => 60,
                'deskripsi' => 'Grooming dasar untuk menjaga kebersihan dan kesehatan hewan.',
            ]
        );

        Service::updateOrCreate(
            ['nama_service' => 'Full Grooming'],
            [
                'harga' => 80000,
                'durasi' => 90,
                'deskripsi' => 'Grooming lengkap meliputi mandi, pengeringan, dan perawatan dasar.',
            ]
        );

        Service::updateOrCreate(
            ['nama_service' => 'Nail Trimming'],
            [
                'harga' => 25000,
                'durasi' => 30,
                'deskripsi' => 'Perawatan dan pemotongan kuku hewan.',
            ]
        );
    }
}