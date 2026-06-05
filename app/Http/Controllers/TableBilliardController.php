<?php

namespace App\Http\Controllers;

use App\Models\TableBilliard;
use Illuminate\Http\Request;

class TableBilliardController extends Controller
{
    // 1. Menampilkan semua daftar meja biliar
    public function index()
    {
        $tables = TableBilliard::latest()->get();
        return view('tables.index', compact('tables'));
    }

    // 2. Menampilkan halaman form tambah meja
    public function create()
    {
        return view('tables.create');
    }

    // 3. Menyimpan data meja baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'number_table' => 'required|string|max:255',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        TableBilliard::create([
            'number_table' => $request->number_table,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'status' => 'available', // default awal meja siap pakai
        ]);

        return redirect()->route('tables.index')->with('success', 'Meja biliar berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman form edit meja
    public function edit(TableBilliard $table)
    {
        return view('tables.edit', compact('table'));
    }

    // 5. Memperbarui data meja di database
    public function update(Request $request, TableBilliard $table)
    {
        $request->validate([
            'number_table' => 'required|string|max:255',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $table->update($request->all());

        return redirect()->route('tables.index')->with('success', 'Data meja berhasil diperbarui!');
    }

    // 6. Menghapus meja dari database
    public function destroy(TableBilliard $table)
    {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Meja biliar berhasil dihapus!');
    }
}