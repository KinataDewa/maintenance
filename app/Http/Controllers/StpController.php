<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StpController extends Controller
{
    public function index()
    {
        // Nanti data bisa diambil dari database, untuk sekarang hardcode saja
        return view('stp.index');
    }

    public function store(Request $request)
    {
        // Sementara hanya validasi sederhana
        $request->validate([
            'shift' => 'required|string',
            'data' => 'array', // nanti untuk semua aktivitas
        ]);

        // Belum ada penyimpanan ke database (hanya flash message)
        return back()->with('success', 'Checklist STP berhasil disimpan untuk Shift ' . $request->shift);
    }
}
