<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExhaustFan;

class ExhaustFanController extends Controller
{
    // Tampilkan semua exhaust fan
    public function index()
    {
        $fans = ExhaustFan::orderBy('nama')->paginate(10);
        return view('exhaustfan.index', compact('fans'));
    }

    // Form tambah baru
    public function create()
    {
        return view('exhaustfan.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
        ]);

        ExhaustFan::create($request->all());

        return redirect()->route('exhaustfan.index')->with('success', 'Exhaust fan berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $fan = ExhaustFan::findOrFail($id);
        return view('exhaustfan.edit', compact('fan'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
        ]);

        $fan = ExhaustFan::findOrFail($id);
        $fan->update($request->all());

        return redirect()->route('exhaustfan.index')->with('success', 'Exhaust fan berhasil diupdate.');
    }

    // Hapus data
    public function destroy($id)
    {
        $fan = ExhaustFan::findOrFail($id);
        $fan->delete();

        return redirect()->route('exhaustfan.index')->with('success', 'Exhaust fan berhasil dihapus.');
    }
}
