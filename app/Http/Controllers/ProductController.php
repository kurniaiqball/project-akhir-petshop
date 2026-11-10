<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Pencarian produk berdasarkan nama
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(
                'nama_product',
                'like',
                "%{$search}%"
            );
        }

        // Filter produk berdasarkan kategori
        if ($request->filled('category')) {
            $query->where(
                'id_category',
                $request->category
            );
        }

        // Ambil produk dengan pagination
        $products = $query
            ->latest('id_product')
            ->paginate(10)
            ->withQueryString();

        // Ambil semua kategori untuk dropdown filter
        $categories = Category::orderBy('nama_category')->get();

        return view('admin.products.index', compact(
            'products',
            'categories'
        ));
    }


    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $categories = Category::orderBy('nama_category')->get();

        return view('admin.products.create', compact('categories'));
    }


    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_category' => ['required', 'exists:categories,id_category'],
            'nama_product' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Upload gambar produk
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail produk.
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }


    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('nama_category')->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }


    /**
     * Memperbarui produk.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'id_category' => ['required', 'exists:categories,id_category'],
            'nama_product' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Upload gambar baru jika tersedia
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }

            // Simpan gambar baru
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Menghapus produk.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar produk
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        try {

            $product->delete();

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi.'
                );
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
