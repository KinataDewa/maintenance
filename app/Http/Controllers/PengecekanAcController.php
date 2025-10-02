<?php

namespace App\Http\Controllers;

use App\Models\PengecekanAc;
use App\Models\Ac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanAcController extends Controller
{
    public function create()
    {
        $acs = Ac::all();
        return view('pengecekan_ac.create', compact('acs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ac_id' => 'required|exists:acs,id',
            'lokasi' => 'required|in:Indoor,Outdoor',
            'pengecekan' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $fotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotos[] = $file->store('pengecekan_ac', 'public');
            }
        }

        PengecekanAc::create([
            'ac_id' => $validated['ac_id'],
            'user_id' => Auth::id() ?? 1, // sementara default 1
            'lokasi' => $validated['lokasi'],
            'pengecekan' => $validated['pengecekan'] ?? [],
            'foto' => $fotos,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Pengecekan AC berhasil disimpan.');
    }

    public function riwayat()
{
    $pengecekanAcs = \App\Models\PengecekanAc::with('ac','user')->latest()->get();
    return view('pengecekan_ac.riwayat', compact('pengecekanAcs'));
}

}
