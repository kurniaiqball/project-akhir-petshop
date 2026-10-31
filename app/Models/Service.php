<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'id_service';

    protected $fillable = [
        'nama_service',
        'harga',
        'durasi',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(
            Booking::class,
            'id_service',
            'id_service'
        );
    }
}