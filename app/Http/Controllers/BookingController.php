<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        $pets = $customer->pets()
            ->orderBy('nama_pet')
            ->get();

        $services = Service::orderBy('nama_service')
            ->get();

        return view(
            'customer.booking',
            compact('pets', 'services')
        );
    }

    public function store(Request $request)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        $validated = $request->validate([
            'id_pet' => [
                'required',
                'exists:pets,id_pet',
            ],

            'id_service' => [
                'required',
                'exists:services,id_service',
            ],

            'tanggal_booking' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'jam_booking' => [
                'required',
                'date_format:H:i',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Pastikan pet milik customer yang sedang login
        |--------------------------------------------------------------------------
        */

        $pet = Pet::where('id_pet', $validated['id_pet'])
            ->where('id_customer', $customer->id_customer)
            ->first();

        if (!$pet) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_pet' =>
                        'Hewan yang dipilih bukan milik akun Anda.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cegah double booking pada tanggal dan jam yang sama
        |--------------------------------------------------------------------------
        */

        $bookingExists = Booking::where(
            'tanggal_booking',
            $validated['tanggal_booking']
        )
            ->where(
                'jam_booking',
                $validated['jam_booking']
            )
            ->whereIn('status', [
                'Menunggu',
                'Dikonfirmasi',
            ])
            ->exists();

        if ($bookingExists) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam_booking' =>
                        'Jam tersebut sudah digunakan. Silakan pilih jam lain.'
                ]);
        }

        $validated['id_customer'] = $customer->id_customer;
        $validated['status'] = 'Menunggu';

        Booking::create($validated);

        return redirect()
            ->route('customer.history')
            ->with(
                'success',
                'Booking grooming berhasil dibuat dan menunggu konfirmasi admin.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER HISTORY
    |--------------------------------------------------------------------------
    */

    public function customerHistory()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        $bookings = Booking::with([
            'pet',
            'service'
        ])
            ->where(
                'id_customer',
                $customer->id_customer
            )
            ->latest('id_booking')
            ->paginate(10);

        return view(
            'customer.history',
            compact('bookings')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request)
    {
        $query = Booking::with([
            'customer',
            'pet',
            'service',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas(
                    'customer',
                    function ($customerQuery) use ($search) {
                        $customerQuery->where(
                            'nama',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

                $q->orWhereHas(
                    'pet',
                    function ($petQuery) use ($search) {
                        $petQuery->where(
                            'nama_pet',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

                $q->orWhereHas(
                    'service',
                    function ($serviceQuery) use ($search) {
                        $serviceQuery->where(
                            'nama_service',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $bookings = $query
            ->orderByDesc('tanggal_booking')
            ->orderByDesc('jam_booking')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.bookings.index',
            compact('bookings')
        );
    }

    public function adminUpdateStatus(
        Request $request,
        Booking $booking
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Menunggu,Dikonfirmasi,Selesai,Dibatalkan',
            ],
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with(
                'success',
                'Status booking berhasil diperbarui.'
            );
    }
}