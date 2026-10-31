<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $makanan = Category::where('nama_category', 'Makanan')->first();
        $vitamin = Category::where('nama_category', 'Vitamin')->first();
        $aksesoris = Category::where('nama_category', 'Aksesoris')->first();
        $pasir = Category::where('nama_category', 'Pasir')->first();

        Product::updateOrCreate(
            ['nama_product' => 'Royal Canin Adult'],
            [
                'id_category' => $makanan->id_category,
                'harga' => 150000,
                'stok' => 20,
                'deskripsi' => 'Makanan kucing dewasa berkualitas untuk menjaga kesehatan dan nutrisi.',
                'gambar' => null,
            ]
        );

        Product::updateOrCreate(
            ['nama_product' => 'Whiskas Tuna'],
            [
                'id_category' => $makanan->id_category,
                'harga' => 35000,
                'stok' => 30,
                'deskripsi' => 'Makanan kucing dengan rasa tuna yang lezat.',
                'gambar' => null,
            ]
        );

        Product::updateOrCreate(
            ['nama_product' => 'Vitamin Kucing'],
            [
                'id_category' => $vitamin->id_category,
                'harga' => 25000,
                'stok' => 15,
                'deskripsi' => 'Vitamin untuk membantu menjaga kesehatan kucing.',
                'gambar' => null,
            ]
        );

        Product::updateOrCreate(
            ['nama_product' => 'Kalung Kucing'],
            [
                'id_category' => $aksesoris->id_category,
                'harga' => 20000,
                'stok' => 10,
                'deskripsi' => 'Kalung kucing dengan desain nyaman dan menarik.',
                'gambar' => null,
            ]
        );

        Product::updateOrCreate(
            ['nama_product' => 'Pasir Kucing 5L'],
            [
                'id_category' => $pasir->id_category,
                'harga' => 45000,
                'stok' => 25,
                'deskripsi' => 'Pasir kucing dengan daya serap tinggi.',
                'gambar' => null,
            ]
        );
    }
}