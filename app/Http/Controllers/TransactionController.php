<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreatedMail;
use App\Mail\OrderReadyForPickupMail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar produk untuk customer.
     */
    public function products(Request $request)
    {
        $query = Product::with('category')
            ->where('stok', '>', 0);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
                    'nama_product',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'deskripsi',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $products = $query
            ->latest('id_product')
            ->paginate(12)
            ->withQueryString();

        return view(
            'customer.products',
            compact('products')
        );
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function addToCart(
        Request $request,
        Product $product
    ) {
        $validated = $request->validate([
            'jumlah' => [
                'required',
                'integer',
                'min:1'
            ],
        ]);

        if ($product->stok < $validated['jumlah']) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah produk melebihi stok yang tersedia.'
                );
        }

        $cart = session()->get('cart', []);

        $id = $product->id_product;

        if (isset($cart[$id])) {

            $jumlahBaru =
                $cart[$id]['jumlah']
                + $validated['jumlah'];

            if ($jumlahBaru > $product->stok) {
                return back()
                    ->with(
                        'error',
                        'Jumlah produk di keranjang melebihi stok.'
                    );
            }

            $cart[$id]['jumlah'] = $jumlahBaru;

        } else {

            $cart[$id] = [
                'id_product' => $product->id_product,
                'nama_product' => $product->nama_product,
                'harga' => $product->harga,
                'gambar' => $product->gambar,
                'jumlah' => $validated['jumlah'],
            ];
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil ditambahkan ke keranjang.'
        );
    }

    /**
     * Menampilkan keranjang.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(
            fn ($item) =>
                $item['harga'] * $item['jumlah']
        );

        return view(
            'customer.cart',
            compact('cart', 'total')
        );
    }

    /**
     * Menghapus produk dari keranjang.
     */
    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);

        unset(
            $cart[$product->id_product]
        );

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk dihapus dari keranjang.'
        );
    }

    /**
     * Menampilkan halaman checkout.
     */
    public function checkout()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(
                403,
                'Data customer tidak ditemukan.'
            );
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('customer.products')
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        $total = collect($cart)->sum(
            fn ($item) =>
                $item['harga'] * $item['jumlah']
        );

        return view(
            'customer.checkout',
            compact(
                'cart',
                'total',
                'customer'
            )
        );
    }

    /**
     * Memproses checkout dan membuat transaksi.
     */
    public function processCheckout()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(
                403,
                'Data customer tidak ditemukan.'
            );
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('customer.products')
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Membuat transaksi
        |--------------------------------------------------------------------------
        */

        $transaction = DB::transaction(
            function () use ($cart, $customer) {

                $total = 0;

                /*
                |--------------------------------------------------------------------------
                | Cek stok semua produk
                |--------------------------------------------------------------------------
                */

                foreach ($cart as $item) {

                    $product = Product::lockForUpdate()
                        ->find($item['id_product']);

                    if (!$product) {
                        abort(
                            404,
                            'Produk tidak ditemukan.'
                        );
                    }

                    if (
                        $product->stok
                        < $item['jumlah']
                    ) {
                        abort(
                            422,
                            "Stok {$product->nama_product} tidak mencukupi."
                        );
                    }

                    $total +=
                        $product->harga
                        * $item['jumlah'];
                }

                /*
                |--------------------------------------------------------------------------
                | Buat transaksi
                |--------------------------------------------------------------------------
                */

                $transaction = Transaction::create([
                    'id_customer' =>
                        $customer->id_customer,

                    'tanggal' =>
                        now(),

                    'total' =>
                        $total,

                    'status' =>
                        'Pending',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Simpan detail transaksi dan kurangi stok
                |--------------------------------------------------------------------------
                */

                foreach ($cart as $item) {

                    $product = Product::lockForUpdate()
                        ->find($item['id_product']);

                    $subtotal =
                        $product->harga
                        * $item['jumlah'];

                    $transaction->details()->create([
                        'id_product' =>
                            $product->id_product,

                        'jumlah' =>
                            $item['jumlah'],

                        'harga' =>
                            $product->harga,

                        'subtotal' =>
                            $subtotal,
                    ]);

                    $product->decrement(
                        'stok',
                        $item['jumlah']
                    );
                }

                return $transaction;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Load data untuk email
        |--------------------------------------------------------------------------
        */

        $transaction->load([
            'customer',
            'details.product',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kirim email ke customer
        |--------------------------------------------------------------------------
        */

        if (!empty($customer->email)) {

            Mail::to($customer->email)
                ->send(
                    new OrderCreatedMail($transaction)
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Kosongkan keranjang
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('customer.transactions')
            ->with(
                'success',
                'Pesanan berhasil dibuat. Konfirmasi pesanan telah dikirim ke email kamu.'
            );
    }

    /**
     * Menampilkan riwayat transaksi customer.
     */
    public function customerTransactions()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            abort(
                403,
                'Data customer tidak ditemukan.'
            );
        }

        $transactions = Transaction::with(
            'details.product'
        )
            ->where(
                'id_customer',
                $customer->id_customer
            )
            ->latest('id_transaction')
            ->paginate(10);

        return view(
            'customer.transactions',
            compact('transactions')
        );
    }

    /**
     * Menampilkan daftar transaksi untuk admin.
     */
    public function adminIndex(Request $request)
    {
        $query = Transaction::with([
            'customer',
            'details.product',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search nama customer
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas(
                'customer',
                function ($q) use ($search) {

                    $q->where(
                        'nama',
                        'like',
                        "%{$search}%"
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter tanggal
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tanggal')) {

            $query->whereDate(
                'tanggal',
                $request->tanggal
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $transactions = $query
            ->latest('id_transaction')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.transactions.index',
            compact('transactions')
        );
    }

    /**
     * Menampilkan detail transaksi untuk admin.
     */
    public function adminShow(
        Transaction $transaction
    ) {
        $transaction->load([
            'customer',
            'details.product.category',
        ]);

        return view(
            'admin.transactions.show',
            compact('transaction')
        );
    }

    
   
/**
 * Admin mengubah status transaksi.
 */

public function adminUpdateStatus(
    Request $request,
    Transaction $transaction
) {
    $validated = $request->validate([
        'status' => [
            'required',
            'in:Pending,Diproses,Siap Diambil,Selesai,Dibatalkan',
        ],
    ]);

    $statusLama = $transaction->status;
    $statusBaru = $validated['status'];

    // Simpan status baru.
    $transaction->update([
        'status' => $statusBaru,
    ]);

    // Kirim email hanya ketika status pertama kali
    // berubah menjadi Siap Diambil.
    if (
        $statusLama !== 'Siap Diambil' &&
        $statusBaru === 'Siap Diambil'
    ) {
        $transaction->load('customer');

        $email = $transaction->customer->email ?? null;

        if ($email) {
            try {
                Mail::to($email)->send(
                    new OrderReadyForPickupMail($transaction)
                );
            } catch (\Throwable $e) {
                report($e);

                return redirect()
                    ->route('admin.transactions.index')
                    ->with(
                        'error',
                        'Status berhasil diubah, tetapi email gagal dikirim.'
                    );
            }
        }
    }

    return redirect()
        ->route('admin.transactions.index')
        ->with(
            'success',
            'Status transaksi berhasil diperbarui.'
        );
}

    

    /**
     * Admin menghapus transaksi dan mengembalikan stok.
     */
    public function adminDestroy(
        Transaction $transaction
    ) {
        DB::transaction(
            function () use ($transaction) {

                $transaction->load('details');

                foreach (
                    $transaction->details
                    as $detail
                ) {

                    $product = Product::find(
                        $detail->id_product
                    );

                    if ($product) {

                        $product->increment(
                            'stok',
                            $detail->jumlah
                        );
                    }
                }

                $transaction->delete();
            }
        );

        return redirect()
            ->route('admin.transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dihapus dan stok produk telah dikembalikan.'
            );
    }
}