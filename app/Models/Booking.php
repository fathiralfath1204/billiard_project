<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'table_billiard_id',
        'customer_name',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    // Hubungkan ke Model TableBilliard
    public function tableBilliard()
    {
        return $this->belongsTo(TableBilliard::class);
    }

    // Hubungkan ke Transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}