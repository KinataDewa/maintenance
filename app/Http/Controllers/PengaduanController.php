<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Room;
use App\Models\PengaduanHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Tampilkan form pengaduan.
     */
    public function create()
    {
        $rooms = Room::all();
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
            'room_id' => 'required',
            'lokasi_lainnya' => 'nullable|string|max:255',
            'pic_nama' => 'required|string|max:255',
            'pic_telp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika diunggah
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        // Tentukan nilai room_id dan lokasi_lainnya
        $room_id = $request->room_id === 'lainnya' ? null : $request->room_id;
        $lokasi_lainnya = $request->room_id === 'lainnya' ? $request->lokasi_lainnya : null;

        // Simpan data ke database
        Pengaduan::create([
            'jenis_kendala' => $request->jenis_kendala,
            'deskripsi' => $request->deskripsi,
            'perangkat_tipe' => $request->perangkat_tipe,
            'perangkat_id' => $request->perangkat_id,
            'perangkat_lainnya' => $request->perangkat_lainnya,
            'room_id' => $room_id,
            'lokasi_lainnya' => $lokasi_lainnya, // ✅ tersimpan
            'pic_nama' => $request->pic_nama,
            'pic_telp' => $request->pic_telp,
            'foto' => $fotoPath,
            'status' => 'Diproses',
            'progres' => 'Diproses',
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function riwayat(Request $request)
    {
        $query = Pengaduan::with('room')->latest();

        // Filter Tanggal
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter Perangkat
        if ($request->perangkat_tipe) {
            $query->where('perangkat_tipe', $request->perangkat_tipe);
        }

        // Filter Ruangan
        if ($request->room_id) {
            $query->where('room_id', $request->room_id);
        }

        $pengaduans = $query->get();

        // Ambil semua rooms untuk filter dropdown
        $rooms = \App\Models\Room::all();

        return view('pengaduan.riwayat', compact('pengaduans', 'rooms'));
    }

    // Edit form
    public function edit(Pengaduan $pengaduan)
    {
        $user = auth()->user();

        // Role check: hanya admin/staff
        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak');
        }

        $statusOptions = [
            'Diproses',
            'Proses PO Barang',
            'Proses Order Barang',
            'Proses Barang Diterima',
            'Proses Pengerjaan',
            'Selesai'
        ];

        return view('pengaduan.edit', compact('pengaduan', 'statusOptions'));
    }

    // Update data pengaduan + simpan riwayat
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $user = auth()->user();

        // Role check: hanya admin/staff
        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'status' => 'required|string|in:Diproses,Proses PO Barang,Proses Order Barang,Proses Barang Diterima,Proses Pengerjaan,Selesai',
            'progres' => 'nullable|string|max:500',
        ]);

        // Simpan riwayat perubahan sebelum update
        PengaduanHistory::create([
            'pengaduan_id' => $pengaduan->id,
            'updated_by' => $user->id,
            'status_lama' => $pengaduan->status,
            'status_baru' => $request->status,
            'progres_lama' => $pengaduan->progres,
            'progres_baru' => $request->progres,
        ]);

        // Update pengaduan
        $pengaduan->update([
            'status' => $request->status,
            'progres' => $request->progres,
        ]);

        return redirect()->route('pengaduan.riwayat')
                        ->with('success', 'Pengaduan berhasil diperbarui dan riwayat disimpan!');
    }
}
