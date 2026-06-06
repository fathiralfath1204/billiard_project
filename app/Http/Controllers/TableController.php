<?php

namespace App\Http\Controllers;

use App\Models\TableBilliard;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index() { 
        $tables = TableBilliard::all(); 
        return view('tables.index', compact('tables')); 
    }
    
    public function create() { return view('tables.create'); }
    
    public function store(Request $request) {
        // Validasi ditambah agar status defaultnya langsung 'available' jika tidak diisi
        $validated = $request->validate([
            'number_table' => 'required|string|max:10',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric',
        ]);

        TableBilliard::create($validated + ['status' => 'available']);
        
        return redirect()->route('tables.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit($id) {
        $table = TableBilliard::findOrFail($id);
        return view('tables.edit', compact('table'));
    }

    public function update(Request $request, $id) {
        $table = TableBilliard::findOrFail($id);
        
        $validated = $request->validate([
            'number_table' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'status' => 'required|in:available,occupied',
        ]);

        $table->update($validated);
        return redirect()->route('tables.index')->with('success', 'Data meja berhasil diupdate!');
    }

    public function destroy($id) {
        TableBilliard::findOrFail($id)->delete();
        return redirect()->route('tables.index')->with('success', 'Meja berhasil dihapus!');
    }
}