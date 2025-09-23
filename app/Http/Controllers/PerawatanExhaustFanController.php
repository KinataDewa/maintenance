<?php

namespace App\Http\Controllers;

use App\Models\PerawatanExhaustFan;
use App\Models\ExhaustFan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatanExhaustFanController extends Controller
{
    public function create()
    {
        $exhaustFans = ExhaustFan::all();

        // checklist default (ubah jika perlu)
        $pengecekanItems = [
            'Pemeriksaan Visual' => [
                'Baling-baling bersih',
                'Tidak ada korosi',
                'Kondisi casing baik',
            ],
            'Pengecekan Operasional' => [
                'Putaran normal',
                'Tidak ada getaran berlebihan',
                'Tidak ada suara aneh',
            ],
        ];

        $perawatanItems = [
            'Pembersihan' => [
                'Membersihkan kipas',
                'Membersihkan grille',
            ],
            'Pelumasan' => [
                'Melumasi bearing',
            ],
            'Penggantian' => [
                'Mengganti komponen aus (belt/seal jika ada)',
            ],
            'Perbaikan' => [
                'Troubleshooting & perbaikan bila ditemukan masalah',
            ],
        ];

        return view('perawatan_exhaust_fans.create', compact('exhaustFans', 'pengecekanItems', 'perawatanItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exhaust_fan_id' => 'required|exists:exhaust_fans,id',
            'status' => 'required|in:Before,After',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'catatan' => 'nullable|string',
            // pengecekan & perawatan optional (no strict validation here)
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $fotoPaths[] = $foto->store('perawatan_exhaust_fans', 'public');
            }
        }

        PerawatanExhaustFan::create([
            'exhaust_fan_id' => $request->exhaust_fan_id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'pengecekan' => $request->input('pengecekan', []),
            'perawatan' => $request->input('perawatan', []),
            'foto' => $fotoPaths,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data perawatan exhaust fan berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $query = PerawatanExhaustFan::with(['exhaustFan', 'user'])->latest();

        if ($request->exhaust_fan_id) {
            $query->where('exhaust_fan_id', $request->exhaust_fan_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->paginate(10)->withQueryString();
        $exhaustFans = ExhaustFan::all();

        return view('perawatan_exhaust_fans.riwayat', compact('riwayat', 'exhaustFans'));
    }
}
