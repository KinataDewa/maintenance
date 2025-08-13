<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeteranListrikInduk;
use Illuminate\Support\Facades\Storage;

class MeteranIndukController extends Controller
{
    // Tampilkan form input
    public function create()
    {
        return view('induk.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'kwh' => 'required|string',
            'cosphi' => 'required|string',
            'kvar' => 'required|string',
            'wbp' => 'required|string',
            'lwbp' => 'required|string',
            'total' => 'required|string',

            'foto_kwh' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_cosphi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kvar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_wbp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_lwbp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_total' => 'required|image|mimes:jpg,jpeg,png|max:2048',

            'keterangan' => 'nullable|string',
        ]);

        $foto_kwh = $request->file('foto_kwh')->store('foto_induk', 'public');
        $foto_cosphi = $request->file('foto_cosphi')->store('foto_induk', 'public');
        $foto_kvar = $request->file('foto_kvar')->store('foto_induk', 'public');
        $foto_wbp = $request->file('foto_wbp')->store('foto_induk', 'public');
        $foto_lwbp = $request->file('foto_lwbp')->store('foto_induk', 'public');
        $foto_total = $request->file('foto_total')->store('foto_induk', 'public');

        MeteranListrikInduk::create([
            'tanggal' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
            'kwh' => $request->kwh,
            'cosphi' => $request->cosphi,
            'kvar' => $request->kvar,
            'wbp' => $request->wbp,
            'lwbp' => $request->lwbp,
            'total' => $request->total,

            'foto_kwh' => $foto_kwh,
            'foto_cosphi' => $foto_cosphi,
            'foto_kvar' => $foto_kvar,
            'foto_wbp' => $foto_wbp,
            'foto_lwbp' => $foto_lwbp,
            'foto_total' => $foto_total,

            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function riwayat(Request $request)
    {
        $query = MeteranListrikInduk::query();

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $data = $query->orderByDesc('tanggal')
                    ->orderByDesc('jam')
                    ->get();

        return view('induk.riwayat', compact('data'));
    }

    public function export(Request $request)
    {
        $tanggal = $request->tanggal;

        return Excel::download(new MeteranIndukExport($tanggal), 'meteran_induk.xlsx');
    }

}
