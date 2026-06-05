<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableBilliard extends Model
{
    // Tambahkan baris ini untuk memberi izin input data ke kolom-kolom berikut:
    protected $fillable = [
        'number_table',
        'type',
        'price_per_hour',
        'status',
    ];
}