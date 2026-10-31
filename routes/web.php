<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CustomerProfileController;

// LANDING PAGE
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');

        // PRODUK
        Route::resource('products', ProductController::class);

        // KATEGORI
        Route::resource('categories', CategoryController::class);

        // CUSTOMER
        Route::resource('customers', CustomerController::class)
            ->only(['index', 'show', 'destroy']);

        // HEWAN
        Route::resource('pets', PetController::class);

        // LAYANAN
        Route::resource('services', ServiceController::class);

        // BOOKING
        Route::get('/bookings', [BookingController::class, 'adminIndex'])
            ->name('bookings.index');

        Route::put(
            '/bookings/{booking}/status',
            [BookingController::class, 'adminUpdateStatus']
        )->name('bookings.status');

        // TRANSAKSI
        Route::get(
            '/transactions',
            [TransactionController::class, 'adminIndex']
        )->name('transactions.index');

        Route::get(
            '/transactions/{transaction}',
            [TransactionController::class, 'adminShow']
        )->name('transactions.show');

        Route::put(
            '/transactions/{transaction}/status',
            [TransactionController::class, 'adminUpdateStatus']
        )->name('transactions.status');

        Route::delete(
            '/transactions/{transaction}',
            [TransactionController::class, 'adminDestroy']
        )->name('transactions.destroy');
    });

// CUSTOMER
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', function () {
            return view('customer.dashboard');
        })->name('dashboard');

        // PROFIL CUSTOMER
        Route::get(
            '/profile',
            [CustomerProfileController::class, 'edit']
        )->name('profile');

        Route::put(
            '/profile',
            [CustomerProfileController::class, 'update']
        )->name('profile.update');

        Route::delete(
            '/profile/foto',
            [CustomerProfileController::class, 'destroyPhoto']
        )->name('profile.photo.destroy');

        // HEWAN SAYA
        Route::get(
            '/pets',
            [PetController::class, 'customerIndex']
        )->name('pets.index');

        Route::get(
            '/pets/create',
            [PetController::class, 'customerCreate']
        )->name('pets.create');

        Route::post(
            '/pets',
            [PetController::class, 'customerStore']
        )->name('pets.store');

        Route::get(
            '/pets/{pet}/edit',
            [PetController::class, 'customerEdit']
        )->name('pets.edit');

        Route::put(
            '/pets/{pet}',
            [PetController::class, 'customerUpdate']
        )->name('pets.update');

        Route::delete(
            '/pets/{pet}',
            [PetController::class, 'customerDestroy']
        )->name('pets.destroy');

        // BOOKING
        Route::get(
            '/booking',
            [BookingController::class, 'create']
        )->name('booking');

        Route::post(
            '/booking',
            [BookingController::class, 'store']
        )->name('booking.store');

        // RIWAYAT BOOKING
        Route::get(
            '/history',
            [BookingController::class, 'customerHistory']
        )->name('history');

        // PRODUK
        Route::get(
            '/products',
            [TransactionController::class, 'products']
        )->name('products');

        // KERANJANG
        Route::post(
            '/products/{product}/cart',
            [TransactionController::class, 'addToCart']
        )->name('cart.add');

        Route::get(
            '/cart',
            [TransactionController::class, 'cart']
        )->name('cart');

        Route::delete(
            '/cart/{product}',
            [TransactionController::class, 'removeFromCart']
        )->name('cart.remove');

        // CHECKOUT
        Route::get(
            '/checkout',
            [TransactionController::class, 'checkout']
        )->name('checkout');

        Route::post(
            '/checkout',
            [TransactionController::class, 'processCheckout']
        )->name('checkout.process');

        // RIWAYAT TRANSAKSI
        Route::get(
            '/transactions',
            [TransactionController::class, 'customerTransactions']
        )->name('transactions');
    });