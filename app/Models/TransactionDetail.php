<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_transaction',
        'id_product',
        'jumlah',
        'harga',
        'subtotal',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function transaction()
    {
        return $this->belongsTo(
            Transaction::class,
            'id_transaction',
            'id_transaction'
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'id_product',
            'id_product'
        );
    }
}