<?php

namespace App\Http\Controllers;

use App\Models\PerawatanPompa;
use App\Models\PompaUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatanPompaController extends Controller
{
    public function create()
    {
        $pompas = PompaUnit::all();

        $pengecekanItems = [
            'Pemeriksaan visual' => [
                'Mengamati kondisi fisik',
                'Mencari kebocoran',
                'Tanda korosi',
                'Kerusakan pada eksterior motor'
            ],
            'Pemeriksaan suara dan getaran' => [
                'Mendengarkan bunyi tidak wajar',
                'Merasakan adanya getaran berlebihan'
            ],
            'Memeriksa suhu' => [
                'Memastikan tidak ada panas berlebih pada motor atau bantalan'
            ],
            'Melihat tingkat oli' => [
                'Memeriksa indikator oli pada bantalan untuk melihat adanya air atau perubahan warna'
            ]
        ];

        $perawatanItems = [
            'Pembersihan' => ['Membersihkan filter', 'Membersihkan impeller', 'Membersihkan komponen lain dari kotoran atau kerak'],
            'Pelumasan' => ['Melumasi bantalan dan komponen yang bergerak sesuai rekomendasi'],
            'Penyesuaian' => ['Menyelaraskan motor atau melakukan penyetelan yang diperlukan'],
            'Penggantian komponen' => ['Mengganti segel, impeller, atau diafragma yang aus'],
            'Troubleshooting dan perbaikan' => ['Mendiagnosis dan memperbaiki masalah saat pengecekan']
        ];

        return view('perawatan_pompa.create', compact('pompas', 'pengecekanItems', 'perawatanItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pompa_unit_id' => 'required|exists:pompa_units,id',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Before,After',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $fotoPaths[] = $foto->store('perawatan_pompa', 'public');
            }
        }

        PerawatanPompa::create([
            'pompa_unit_id' => $request->pompa_unit_id,
            'pengecekan' => $request->input('pengecekan', []),
            'perawatan' => $request->input('perawatan', []),
            'foto' => $fotoPaths,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data perawatan pompa berhasil disimpan.');
    }

    public function index()
    {
        $riwayat = PerawatanPompa::with(['pompaUnit', 'user'])->latest()->paginate(10);
        return view('perawatan_pompa.riwayat', compact('riwayat'));
    }
    public function riwayat(Request $request)
{
    $query = PerawatanPompa::with(['pompaUnit', 'user'])->latest();

    if ($request->pompa_unit_id) {
        $query->where('pompa_unit_id', $request->pompa_unit_id);
    }

    if ($request->tanggal) {
        $query->whereDate('created_at', $request->tanggal);
    }

    $riwayat = $query->paginate(10);
    $pompaUnits = PompaUnit::all();

    return view('perawatan_pompa.riwayat', compact('riwayat', 'pompaUnits'));
}

}
