<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalApiController extends Controller
{
    public function index()
    {
        // 1. Tembak URL API Eksternal (Mengambil data kurs mata uang terhadap Rupiah IDR)
        $response = Http::get('https://open.er-api.com/v6/latest/IDR');

        // 2. Cek apakah API eksternal berhasil merespon
        if ($response->successful()) {
            $data = $response->json();
            
            // Kita ambil beberapa kurs penting saja untuk ditampilkan, dibalik rumusnya (1 USD = berapa IDR)
            $rates = [
                'USD' => round(1 / $data['rates']['USD'], 2),
                'SGD' => round(1 / $data['rates']['SGD'], 2),
                'EUR' => round(1 / $data['rates']['EUR'], 2),
                'AUD' => round(1 / $data['rates']['AUD'], 2),
            ];
            
            $lastUpdate = $data['time_last_update_utc'];
        } else {
            // Jika API eksternal down, buat data cadangan (fallback)
            $rates = ['USD' => 16000, 'SGD' => 11800, 'EUR' => 17000, 'AUD' => 10500];
            $lastUpdate = 'Gagal memuat waktu waktu asli';
        }

        // 3. Lempar data dari API luar tersebut ke halaman view dashboard kamu
        return view('dashboard', compact('rates', 'lastUpdate'));
    }
}