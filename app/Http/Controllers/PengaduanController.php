<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Tampilkan form pengaduan.
     */
    public function create()
    {
        $rooms = Room::all(); // ambil semua data ruangan
        return view('pengaduan.create', compact('rooms'));
    }

    /**
     * Simpan data pengaduan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendala' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'perangkat_tipe' => 'nullable|string',
            'perangkat_id' => 'nullable|integer',
            'perangkat_lainnya' => 'nullable|string|max:255',
            'room_id' => 'required|integer',
            'pic_nama' => 'required|string|max:255',
            'pic_telp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika diunggah
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        // Simpan data ke database
        Pengaduan::create([
            'jenis_kendala' => $request->jenis_kendala,
            'deskripsi' => $request->deskripsi,
            'perangkat_tipe' => $request->perangkat_tipe,
            'perangkat_id' => $request->perangkat_id,
            'perangkat_lainnya' => $request->perangkat_lainnya,
            'room_id' => $request->room_id,
            'pic_nama' => $request->pic_nama,
            'pic_telp' => $request->pic_telp,
            'foto' => $fotoPath,
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function riwayat()
    {
        $pengaduans = Pengaduan::with('room')->latest()->get();
        return view('pengaduan.riwayat', compact('pengaduans'));
    }

}
