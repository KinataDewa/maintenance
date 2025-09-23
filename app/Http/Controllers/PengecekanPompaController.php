<?php

namespace App\Http\Controllers;

use App\Models\PengecekanPompa;
use App\Models\PompaUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanPompaController extends Controller
{
    /**
     * Menampilkan form input pengecekan pompa
     */
    public function create()
    {
        $pompas = PompaUnit::all();
        return view('pengecekan_pompas.create', compact('pompas'));
    }

    /**
     * Menyimpan data pengecekan pompa
     */
    public function store(Request $request)
    {
        $request->validate([
            'pompa_unit_id' => 'required|exists:pompa_units,id',
            'suhu'          => 'nullable|numeric',
            'tekanan'       => 'nullable|numeric',
            'foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $fotoPaths[] = $foto->store('pengecekan_pompa', 'public');
            }
        }

        // Simpan data ke database
        PengecekanPompa::create([
            'pompa_unit_id' => $request->pompa_unit_id,
            'pengecekan'    => $request->input('pengecekan', []),
            'suhu'          => $request->suhu,
            'tekanan'       => $request->tekanan,
            'foto'          => $fotoPaths,
            'catatan'       => $request->catatan,
            'user_id'       => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data pengecekan pompa berhasil disimpan.');
    }

    /**
     * Menampilkan riwayat pengecekan pompa
     */
    public function index()
    {
        $riwayat = PengecekanPompa::with(['pompaUnit', 'user'])->latest()->paginate(10);
        return view('pengecekan_pompas.riwayat', compact('riwayat'));
    }
}
