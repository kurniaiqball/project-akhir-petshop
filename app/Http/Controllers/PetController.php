<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class PetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pets = Pet::with('customer')
            ->latest('id_pet')
            ->paginate(10);

        return view('admin.pets.index', compact('pets'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();

        return view('admin.pets.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'nama_pet' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'ras' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'umur_tahun' => 'nullable|integer|min:0',
            'umur_bulan' => 'nullable|integer|min:0|max:11',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('pets', 'public');
        }

        Pet::create($validated);

        return redirect()
            ->route('admin.pets.index')
            ->with('success', 'Data hewan berhasil ditambahkan.');
    }

    public function show(Pet $pet)
    {
        $pet->load('customer');

        return view('admin.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $customers = Customer::orderBy('nama')->get();

        return view(
            'admin.pets.edit',
            compact('pet', 'customers')
        );
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'nama_pet' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'ras' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'umur_tahun' => 'nullable|integer|min:0',
            'umur_bulan' => 'nullable|integer|min:0|max:11',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto' => 'sometimes|boolean',
        ]);

        $fotoLama = $pet->foto;
        $hapusFoto = $request->boolean('hapus_foto');
        $fotoBerubah = false;

        unset($validated['hapus_foto']);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('pets', 'public');

            $fotoBerubah = true;
        } elseif ($hapusFoto) {
            $validated['foto'] = null;
            $fotoBerubah = true;
        }

        $pet->update($validated);

        if ($fotoBerubah && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('admin.pets.index')
            ->with('success', 'Data hewan berhasil diperbarui.');
    }

    public function destroy(Pet $pet)
    {
        try {
            $foto = $pet->foto;

            $pet->delete();

            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            return redirect()
                ->route('admin.pets.index')
                ->with('success', 'Data hewan berhasil dihapus.');

        } catch (QueryException $e) {
            return redirect()
                ->route('admin.pets.index')
                ->with(
                    'error',
                    'Hewan tidak dapat dihapus karena sudah memiliki riwayat booking.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function customerIndex()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        $pets = Pet::where('id_customer', $customer->id_customer)
            ->latest('id_pet')
            ->get();

        return view('customer.pets.index', compact('pets'));
    }

    public function customerCreate()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        return view('customer.pets.create');
    }

    public function customerStore(Request $request)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_pet' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'ras' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'umur_tahun' => 'nullable|integer|min:0',
            'umur_bulan' => 'nullable|integer|min:0|max:11',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['id_customer'] = $customer->id_customer;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('pets', 'public');
        }

        Pet::create($validated);

        return redirect()
            ->route('customer.pets.index')
            ->with('success', 'Hewan berhasil ditambahkan.');
    }

    public function customerEdit(Pet $pet)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        if ((int) $pet->id_customer !== (int) $customer->id_customer) {
            abort(403, 'Kamu tidak memiliki akses ke data hewan ini.');
        }

        return view('customer.pets.edit', compact('pet'));
    }

    public function customerUpdate(Request $request, Pet $pet)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        if ((int) $pet->id_customer !== (int) $customer->id_customer) {
            abort(403, 'Kamu tidak memiliki akses ke data hewan ini.');
        }

        $validated = $request->validate([
            'nama_pet' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'ras' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'umur_tahun' => 'nullable|integer|min:0',
            'umur_bulan' => 'nullable|integer|min:0|max:11',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto' => 'sometimes|boolean',
        ]);

        $fotoLama = $pet->foto;
        $hapusFoto = $request->boolean('hapus_foto');
        $fotoBerubah = false;

        unset($validated['hapus_foto']);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('pets', 'public');

            $fotoBerubah = true;
        } elseif ($hapusFoto) {
            $validated['foto'] = null;
            $fotoBerubah = true;
        }

        $pet->update($validated);

        if ($fotoBerubah && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('customer.pets.index')
            ->with('success', 'Data hewan berhasil diperbarui.');
    }

    public function customerDestroy(Pet $pet)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(403, 'Data customer tidak ditemukan.');
        }

        if ((int) $pet->id_customer !== (int) $customer->id_customer) {
            abort(403, 'Kamu tidak memiliki akses ke data hewan ini.');
        }

        try {
            $foto = $pet->foto;

            $pet->delete();

            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            return redirect()
                ->route('customer.pets.index')
                ->with('success', 'Hewan berhasil dihapus.');

        } catch (QueryException $e) {
            return redirect()
                ->route('customer.pets.index')
                ->with(
                    'error',
                    'Hewan tidak dapat dihapus karena sudah memiliki riwayat booking.'
                );
        }
    }
}
