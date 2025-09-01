<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemakaianAir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemakaianAirController extends Controller
{
    // Form input
    public function create()
    {
        return view('pemakaian_air.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'sumber_air' => 'required|in:PDAM,STP',
            'meteran' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pemakaian_air', 'public');
        }

        PemakaianAir::create([
            'user_id' => Auth::id(),
            'sumber_air' => $request->sumber_air,
            'meteran' => $request->meteran,
            'foto' => $fotoPath,
            'deskripsi' => $request->deskripsi,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s'),
        ]);

        return redirect()->route('pemakaian-air.create')
            ->with('success', 'Data pemakaian air berhasil disimpan.');
    }

    // Riwayat
   // Riwayat
public function riwayat(Request $request)
{
    $query = PemakaianAir::with('user');

    // Filter jenis pompa (PDAM / STP)
    if ($request->filled('sumber_air')) {
        $query->where('sumber_air', $request->sumber_air);
    }

    // Filter tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // Urutkan terbaru dulu
    $data = $query->orderBy('tanggal', 'desc')
                  ->orderBy('waktu', 'desc')
                  ->get();

    return view('pemakaian_air.riwayat', compact('data'));
}

}
