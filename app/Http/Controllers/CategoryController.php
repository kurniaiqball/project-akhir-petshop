<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(
                'nama_category',
                'like',
                "%{$search}%"
            );
        }

        $categories = $query
            ->latest('id_category')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_category' => [
                'required',
                'string',
                'max:100',
                'unique:categories,nama_category',
            ],
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan.'
            );
    }

    public function edit(Category $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(
        Request $request,
        Category $category
    ) {
        $validated = $request->validate([
            'nama_category' => [
                'required',
                'string',
                'max:100',
                'unique:categories,nama_category,' .
                $category->id_category .
                ',id_category',
            ],
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui.'
            );
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih digunakan oleh produk.'
                );
        }

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}