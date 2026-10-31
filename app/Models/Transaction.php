<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_customer',
        'tanggal',
        'total',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );
    }

    public function details()
    {
        return $this->hasMany(
            TransactionDetail::class,
            'id_transaction',
            'id_transaction'
        );
    }
}