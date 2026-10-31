<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Makanan',
            'Vitamin',
            'Aksesoris',
            'Pasir',
            'Perawatan',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['nama_category' => $category]
            );
        }
    }
}