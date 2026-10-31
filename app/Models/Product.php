<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_category',
        'nama_product',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'id_category',
            'id_category'
        );
    }

    public function transactionDetails()
    {
        return $this->hasMany(
            TransactionDetail::class,
            'id_product',
            'id_product'
        );
    }
}