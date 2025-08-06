<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeteranListrikInduk;
use Illuminate\Support\Facades\Storage;

class MeteranIndukController extends Controller
{
    // Tampilkan form input
    public function create()
    {
        return view('induk.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'kwh' => 'nullable|numeric',
            'kvar' => 'nullable|numeric',
            'cosphi' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_induk', 'public');
        }

        MeteranListrikInduk::create([
            'tanggal' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
            'kwh' => $request->kwh,
            'kvar' => $request->kvar,
            'cosphi' => $request->cosphi,
            'foto' => $fotoPath,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function riwayat()
    {
        $data = MeteranListrikInduk::orderByDesc('tanggal')->orderByDesc('jam')->get();
        return view('induk.riwayat', compact('data'));
    }

    public function export(Request $request)
    {
        $tanggal = $request->tanggal;

        return Excel::download(new MeteranIndukExport($tanggal), 'meteran_induk.xlsx');
    }

}
