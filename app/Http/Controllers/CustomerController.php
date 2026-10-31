<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with('user');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $customers = $query
            ->latest('id_customer')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.customers.index',
            compact('customers')
        );
    }

    public function show(Customer $customer)
    {
        $customer->load([
            'user',
            'pets',
            'bookings.service',
            'bookings.pet',
            'transactions',
        ]);

        return view(
            'admin.customers.show',
            compact('customer')
        );
    }

    public function destroy(Customer $customer)
    {
        // Simpan lokasi foto untuk dibersihkan setelah data berhasil dihapus.
        $foto = $customer->foto;

        try {
            $customer->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.customers.index')
                ->with(
                    'error',
                    'Customer tidak dapat dihapus karena masih memiliki data transaksi atau booking.'
                );
        }

        // Hapus file foto hanya jika penghapusan customer berhasil.
        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('admin.customers.index')
            ->with(
                'success',
                'Customer berhasil dihapus.'
            );
    }
}