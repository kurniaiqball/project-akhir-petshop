<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_customer',
        'id_pet',
        'id_service',
        'tanggal_booking',
        'jam_booking',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );
    }

    public function pet()
    {
        return $this->belongsTo(
            Pet::class,
            'id_pet',
            'id_pet'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'id_service',
            'id_service'
        );
    }
}