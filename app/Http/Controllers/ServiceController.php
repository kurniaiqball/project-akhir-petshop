<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_service', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $services = $query
            ->latest('id_service')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.services.index',
            compact('services')
        );
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_service' => [
                'required',
                'string',
                'max:100',
            ],
            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'durasi' => [
                'required',
                'integer',
                'min:1',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('services', 'public');
        }

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Layanan berhasil ditambahkan.'
            );
    }

    public function show(Service $service)
    {
        $service->load('bookings');

        return view(
            'admin.services.show',
            compact('service')
        );
    }

    public function edit(Service $service)
    {
        return view(
            'admin.services.edit',
            compact('service')
        );
    }

    public function update(
        Request $request,
        Service $service
    ) {
        $validated = $request->validate([
            'nama_service' => [
                'required',
                'string',
                'max:100',
            ],
            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'durasi' => [
                'required',
                'integer',
                'min:1',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $fotoLama = $service->foto;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('services', 'public');
        } else {
            unset($validated['foto']);
        }

        $service->update($validated);

        // Hapus foto lama setelah foto baru berhasil disimpan
        if (
            $request->hasFile('foto') &&
            $fotoLama &&
            Storage::disk('public')->exists($fotoLama)
        ) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Layanan berhasil diperbarui.'
            );
    }

    public function destroy(Service $service)
    {
        $foto = $service->foto;

        try {
            $service->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('admin.services.index')
                ->with(
                    'error',
                    'Layanan tidak dapat dihapus karena masih digunakan dalam booking.'
                );
        }

        // Hapus foto setelah data layanan berhasil dihapus
        if (
            $foto &&
            Storage::disk('public')->exists($foto)
        ) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Layanan berhasil dihapus.'
            );
    }
}
