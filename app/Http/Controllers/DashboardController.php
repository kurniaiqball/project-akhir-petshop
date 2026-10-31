<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function admin()
    {
        $jumlahProduk = Product::count();
        $jumlahCustomer = Customer::count();
        $jumlahHewan = Pet::count();
        $jumlahBooking = Booking::count();

        $bookingTerbaru = Booking::with([
            'customer',
            'pet',
            'service'
        ])
        ->latest('id_booking')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact(
            'jumlahProduk',
            'jumlahCustomer',
            'jumlahHewan',
            'jumlahBooking',
            'bookingTerbaru'
        ));
    }
}