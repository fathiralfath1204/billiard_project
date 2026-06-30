<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'booking_id',
        'invoice_number',
        'total_amount',
        'payment_method',
        'status',
        'paid_at',
        'cashier_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function cashier()
    {
        return $this->belongsTo(\App\Models\User::class, 'cashier_id');
    }
}