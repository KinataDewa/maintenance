<?php

namespace App\Http\Controllers;

use App\Models\PengecekanExhaustFan;
use App\Models\ExhaustFan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanExhaustFanController extends Controller
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

        return view('pengecekan_exhaust_fans.create', compact('exhaustFans', 'pengecekanItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exhaust_fan_id' => 'required|exists:exhaust_fans,id',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'catatan' => 'nullable|string',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $fotoPaths[] = $foto->store('pengecekan_exhaust_fans', 'public');
            }
        }

        PengecekanExhaustFan::create([
            'exhaust_fan_id' => $request->exhaust_fan_id,
            'user_id' => Auth::id(),
            'pengecekan' => $request->input('pengecekan', []),
            'foto' => $fotoPaths,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pengecekan exhaust fan berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $query = PengecekanExhaustFan::with(['exhaustFan', 'user'])->latest();

        if ($request->exhaust_fan_id) {
            $query->where('exhaust_fan_id', $request->exhaust_fan_id);
        }
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->paginate(10)->withQueryString();
        $exhaustFans = ExhaustFan::all();

        return view('pengecekan_exhaust_fans.riwayat', compact('riwayat', 'exhaustFans'));
    }
}
