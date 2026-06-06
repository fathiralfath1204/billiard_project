<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableBilliard extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'number_table',
        'type',
        'price_per_hour',
        'status',
    ];

    // Relasi ke tabel Bookings (Satu meja bisa punya banyak transaksi booking)
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'table_billiard_id');
    }
}