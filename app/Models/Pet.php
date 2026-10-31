<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $primaryKey = 'id_pet';

    protected $fillable = [
        'id_customer',
        'nama_pet',
        'jenis',
        'ras',
        'jenis_kelamin',
        'umur_tahun',
        'umur_bulan',
        'catatan',
        'foto',
    ];

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );
    }

    public function bookings()
    {
        return $this->hasMany(
            Booking::class,
            'id_pet',
            'id_pet'
        );
    }
}
