<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
{
    public function edit()
    {
        $customer = Auth::user()->customer;

        abort_unless($customer, 404);

        return view('customer.profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::user()->customer;

        abort_unless($customer, 404);

        $validated = $request->validate([
            'foto' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WebP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $fotoLama = $customer->foto;

        $path = $request->file('foto')
            ->store('customers', 'public');

        if (!$path) {
            return back()->with(
                'error',
                'Foto gagal disimpan. Silakan coba lagi.'
            );
        }

        $customer->foto = $path;
        $customer->save();

        // Hapus foto lama setelah foto baru berhasil disimpan.
        if ($fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return back()->with(
            'success',
            'Foto profil berhasil diperbarui.'
        );
    }

    public function destroyPhoto()
    {
        $customer = Auth::user()->customer;

        abort_unless($customer, 404);

        if ($customer->foto) {
            Storage::disk('public')->delete($customer->foto);

            $customer->foto = null;
            $customer->save();
        }

        return back()->with(
            'success',
            'Foto profil berhasil dihapus.'
        );
    }
}