<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TableBilliard;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    // API 1: Mengambil semua daftar meja billiard
    public function getTables()
    {
        $tables = TableBilliard::all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar meja billiard',
            'data'    => $tables
        ], 200);
    }

    // API 2: Mengubah status meja (Sangat berguna untuk sinkronisasi Alat IoT Lampu Meja)
    public function toggleStatus(Request $request, $id)
    {
        $table = TableBilliard::find($id);

        if (!$table) {
            return response()->json([
                'success' => false,
                'message' => 'Meja tidak ditemukan'
            ], 404);
        }

        // Validasi input status baru (harus available atau occupied)
        $validated = $request->validate([
            'status' => 'required|in:available,occupied'
        ]);

        // Update status meja di database
        $table->update([
            'status' => $validated['status']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status meja ' . $table->number_table . ' berhasil diperbarui',
            'data'    => $table
        ], 200);
    }
}