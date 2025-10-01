<?php

namespace App\Http\Controllers;

use App\Models\PerawatanAc;
use App\Models\Ac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatanAcController extends Controller
{
    public function create()
    {
        $acs = Ac::all();
        return view('perawatan_ac.create', compact('acs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ac_id' => 'required|exists:acs,id',
            'lokasi' => 'required|in:Indoor,Outdoor',
            'status' => 'required|in:Before,After',
            'pengecekan' => 'nullable|array',
            'perawatan' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $fotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotos[] = $file->store('perawatan_ac', 'public');
            }
        }

        PerawatanAc::create([
            'ac_id' => $validated['ac_id'],
            'user_id' => Auth::id() ?? 1, // sementara default 1
            'lokasi' => $validated['lokasi'],
            'status' => $validated['status'],
            'pengecekan' => $validated['pengecekan'] ?? [],
            'perawatan' => $validated['perawatan'] ?? [],
            'foto' => $fotos,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Perawatan AC berhasil disimpan.');
    }

    public function riwayat()
{
    $perawatanAcs = \App\Models\PerawatanAc::with('ac','user')->latest()->get();
    return view('perawatan_ac.riwayat', compact('perawatanAcs'));
}

}
