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
        $request->validate(['number_table' => 'required', 'price_per_hour' => 'required|numeric']);
        TableBilliard::create($request->all());
        return redirect()->route('tables.index');
    }

    public function edit($id) {
        $table = TableBilliard::findOrFail($id);
        return view('tables.edit', compact('table'));
    }

    public function update(Request $request, $id) {
        $table = TableBilliard::findOrFail($id);
        $table->update($request->all());
        return redirect()->route('tables.index');
    }

    public function destroy($id) {
        TableBilliard::findOrFail($id)->delete();
        return redirect()->route('tables.index');
    }
}