<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================================================
    // LOGIN
    // =========================================================

    public function showLogin()
    {
        // Kalau sudah login, jangan kembali ke halaman login
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('customer.dashboard');
        }

        return view('auth.login');
    }


    // =========================================================
    // PROSES LOGIN
    // =========================================================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => [
                'required',
                'string'
            ],

            'password' => [
                'required',
                'string'
            ],
        ], [
            'login.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);


        // Bisa login menggunakan username ATAU email
        $login = $credentials['login'];

        $field = filter_var(
            $login,
            FILTER_VALIDATE_EMAIL
        )
            ? 'email'
            : 'username';


        $remember = $request->boolean('remember');


        if (
            Auth::attempt(
                [
                    $field => $login,
                    'password' => $credentials['password'],
                ],
                $remember
            )
        ) {

            $request->session()->regenerate();


            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {

                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'success',
                        'Selamat datang kembali, Admin!'
                    );
            }


            return redirect()
                ->route('customer.dashboard')
                ->with(
                    'success',
                    'Login berhasil. Selamat datang di PetCare!'
                );
        }


        return back()
            ->withInput($request->only('login', 'remember'))
            ->withErrors([
                'login' => 'Username/email atau password salah.',
            ]);
    }


    // =========================================================
    // HALAMAN REGISTER
    // =========================================================

    public function showRegister()
    {
        // Kalau sudah login, langsung arahkan ke dashboard
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('customer.dashboard');
        }

        return view('auth.register');
    }


    // =========================================================
    // PROSES REGISTER
    // =========================================================

    public function register(Request $request)
    {
        $validated = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:100'
            ],

            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'alpha_dash',
                'unique:users,username'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:users,email',
                'unique:customers,email'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20'
            ],

            'alamat' => [
                'nullable',
                'string'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],

        ], [

            'nama.required' =>
                'Nama lengkap wajib diisi.',

            'username.required' =>
                'Username wajib diisi.',

            'username.min' =>
                'Username minimal 3 karakter.',

            'username.unique' =>
                'Username sudah digunakan.',

            'username.alpha_dash' =>
                'Username hanya boleh berisi huruf, angka, tanda hubung, dan underscore.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email sudah digunakan.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak cocok.',
        ]);


        // =====================================================
        // SIMPAN USER + CUSTOMER
        // =====================================================

        DB::transaction(function () use ($validated) {

            $user = User::create([

                'name' => $validated['nama'],

                'username' => $validated['username'],

                'email' => $validated['email'],

                'password' => Hash::make(
                    $validated['password']
                ),

                // Registrasi publik selalu customer
                'role' => 'customer',
            ]);


            Customer::create([

                'id_user' => $user->id_user,

                'nama' => $validated['nama'],

                'email' => $validated['email'],

                'no_hp' => $validated['no_hp'] ?? null,

                'alamat' => $validated['alamat'] ?? null,
            ]);
        });


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registrasi berhasil! Silakan login menggunakan akun yang telah dibuat.'
            );
    }


    // =========================================================
    // LOGOUT
    // =========================================================

    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}