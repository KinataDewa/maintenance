<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    public function index()
    {
        $perangkat = Perangkat::all();
        return view('perangkat.index', compact('perangkat'));
    }

    public function create()
    {
        return view('perangkat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        Perangkat::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function edit(Perangkat $perangkat)
    {
        return view('perangkat.edit', compact('perangkat'));
    }

    public function update(Request $request, Perangkat $perangkat)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        $perangkat->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Perangkat berhasil diperbarui.');
    }

    public function destroy(Perangkat $perangkat)
    {
        $perangkat->delete();
        return redirect()->route('perangkat.index')->with('success', 'Perangkat berhasil dihapus.');
    }
}
