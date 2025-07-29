<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuhuRuanganController extends Controller
{
    // Menampilkan halaman cek suhu ruangan
    public function index()
    {
        // Daftar lokasi lantai untuk dropdown
        $lokasi = ['Ground', 'Lantai 1', 'Lantai 2', 'Lantai 3', 'Lantai 4', 'Lantai 5', 'Lantai 6'];

        return view('suhu.index', compact('lokasi'));
    }

    // Menyimpan data suhu & kelembapan
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'shift' => 'required|string',
            'suhu' => 'required|numeric',
            'kelembapan' => 'required|numeric',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Untuk sementara hanya dump data (bisa diganti ke DB nanti)
        return back()->with('success', 'Data suhu berhasil disimpan: ' . $request->lokasi);
    }
}
