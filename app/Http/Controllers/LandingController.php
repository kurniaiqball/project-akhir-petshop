<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('stok', '>', 0)
            ->latest('id_product')
            ->take(4)
            ->get();

        $services = Service::latest('id_service')
            ->take(3)
            ->get();

        return view('landing.index', compact(
            'products',
            'services'
        ));
    }
}