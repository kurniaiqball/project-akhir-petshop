<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    public function pets()
    {
        return $this->hasMany(
            Pet::class,
            'id_customer',
            'id_customer'
        );
    }

    public function bookings()
    {
        return $this->hasMany(
            Booking::class,
            'id_customer',
            'id_customer'
        );
    }

    public function transactions()
    {
        return $this->hasMany(
            Transaction::class,
            'id_customer',
            'id_customer'
        );
    }
}