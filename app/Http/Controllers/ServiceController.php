<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

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
        ]);

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
        ]);

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Layanan berhasil diperbarui.'
            );
    }

    public function destroy(Service $service)
    {
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

        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Layanan berhasil dihapus.'
            );
    }
}