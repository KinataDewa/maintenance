<?php

namespace App\Http\Controllers;

use App\Models\Ac;
use Illuminate\Http\Request;

class AcController extends Controller
{
    /**
     * Tampilkan daftar AC.
     */
    public function index()
    {
        $acs = Ac::all();
        return view('acs.index', compact('acs'));
    }

    /**
     * Form tambah AC baru.
     */
    public function create()
    {
        return view('acs.create');
    }

    /**
     * Simpan AC baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'nomor' => 'required|string|max:100|unique:acs',
            'merk' => 'required|string|max:100',
        ]);

        Ac::create($request->all());

        return redirect()->route('acs.index')->with('success', 'Data AC berhasil ditambahkan.');
    }

    /**
     * Form edit AC.
     */
    public function edit(Ac $ac)
    {
        return view('acs.edit', compact('ac'));
    }

    /**
     * Update data AC.
     */
    public function update(Request $request, Ac $ac)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'nomor' => 'required|string|max:100|unique:acs,nomor,' . $ac->id,
            'merk' => 'required|string|max:100',
        ]);

        $ac->update($request->all());

        return redirect()->route('acs.index')->with('success', 'Data AC berhasil diperbarui.');
    }

    /**
     * Hapus data AC.
     */
    public function destroy(Ac $ac)
    {
        $ac->delete();
        return redirect()->route('acs.index')->with('success', 'Data AC berhasil dihapus.');
    }
}
