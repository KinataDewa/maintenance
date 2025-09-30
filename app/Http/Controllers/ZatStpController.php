<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZatStp;

class ZatStpController extends Controller
{
    // Halaman input data
    public function create()
    {
        return view('zat_stp.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cek_ph_nilai'   => 'nullable|string|max:50',
            'cek_ph_foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'klorin_nilai'   => 'nullable|string|max:50',
            'klorin_foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bakteri_nilai'  => 'nullable|string|max:50',
            'bakteri_foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lumpur_nilai'   => 'nullable|string|max:50',
            'lumpur_foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'tanggal' => now()->toDateString(),
        ];

        // Proses upload foto
        foreach (['cek_ph', 'klorin', 'bakteri', 'lumpur'] as $item) {
            if ($request->hasFile($item.'_foto')) {
                $data[$item.'_foto'] = $request->file($item.'_foto')->store('stp', 'public');
            }

            if ($request->filled($item.'_nilai')) {
                $data[$item.'_nilai'] = $request->input($item.'_nilai');
            }
        }

        ZatStp::create($data);

        return redirect()->route('zat-stp.riwayat')->with('success', 'Data Zat STP berhasil disimpan.');
    }

    // Tampilkan riwayat data
    public function riwayat()
    {
        $data = ZatStp::orderBy('tanggal', 'desc')->paginate(10);
        return view('zat_stp.riwayat', compact('data'));
    }
}
