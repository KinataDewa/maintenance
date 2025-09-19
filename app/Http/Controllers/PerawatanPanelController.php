<?php

namespace App\Http\Controllers;

use App\Models\PerawatanPanel;
use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerawatanPanelController extends Controller
{
    /**
     * Form untuk input perawatan panel
     */
    public function create()
    {
        $panels = Panel::all(); // ambil semua data panel
        return view('perawatan_panels.create', compact('panels'));
    }

    /**
     * Simpan data perawatan panel
     */
    public function store(Request $request)
    {
        $request->validate([
            'panel_id' => 'required|exists:panels,id',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('panel_photos', 'public');
                $fotoPaths[] = $path;
            }
        }

            // Simpan ke database
            PerawatanPanel::create([
                'panel_id' => $request->panel_id,
                'pengecekan' => [
                    'visual' => $request->input('pengecekan.visual', []),
                    'pengujian' => $request->input('pengecekan.pengujian', []),
                    'lingkungan' => $request->input('pengecekan.lingkungan', []),
                ],
                'perawatan' => [
                    'pembersihan' => $request->input('perawatan.pembersihan', []),
                    'pengencangan_koneksi' => $request->input('perawatan.pengencangan_koneksi', []),
                    'penggantian_komponen' => $request->input('perawatan.penggantian_komponen', []),
                    'perbaikan' => $request->input('perawatan.perbaikan', []),
                ],
                'status' => $request->status, // <--- ini
                'foto' => $fotoPaths,
                'catatan' => $request->catatan,
                'user_id' => Auth::id(),
            ]);

        return redirect()->back()->with('success', 'Data perawatan panel berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        // Ambil semua data perawatan dengan relasi panel dan user
        $riwayat = \App\Models\PerawatanPanel::with(['panel', 'user'])
            ->latest()
            ->paginate(10); // pagination 10 data per halaman

        return view('perawatan_panels.riwayat', compact('riwayat'));
    }

}
