<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StpController extends Controller
{
    public function index() {
        return view('stp.index');
    }

    public function meteran() {
        return view('stp.meteran'); // halaman input meteran
    }

    public function storeMeteran(Request $request) {
        $request->validate([
            'meteran' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika ada
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('stp_meteran', 'public');
        }

        // sementara simpan ke log/debug
        // nanti bisa disimpan ke tabel database
        return back()->with('success', 'Meteran STP berhasil disimpan!');
    }

    public function perawatan() {
        return view('stp.perawatan'); // halaman input perawatan
    }

    public function monitoring() {
        return view('stp.monitoring');
    }
}
