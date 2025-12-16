<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perbaikan;
use App\Models\Ac;
use App\Models\ExhaustFan;
use App\Models\Panel;
use App\Models\Perangkat;
use App\Models\PompaUnit;

class PerbaikanController extends Controller
{
    public function create()
    {
        $acs = Ac::all();
        $exhaustFans = ExhaustFan::all();
        $panels = Panel::all();
        $perangkats = Perangkat::all();
        $pompas = PompaUnit::all();

        return view('perbaikan.create', compact('acs', 'exhaustFans', 'panels', 'perangkats', 'pompas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'np' => 'required|integer',
            'jenis_perangkat' => 'required',
            'perangkat_id' => 'required',
            'nama_perangkat' => 'required',
            'jenis_kerusakan' => 'required',
        ]);

        Perbaikan::create([
            'np' => $request->np,
            'jenis_perangkat' => $request->jenis_perangkat,
            'perangkat_id' => $request->perangkat_id,
            'nama_perangkat' => $request->nama_perangkat,
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'tindakan_perbaikan' => $request->tindakan_perbaikan,
            'catatan' => $request->catatan,
            'foto' => $request->foto ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Data perbaikan berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum,proses,sudah',
            'biaya' => 'nullable|numeric',
        ]);

        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->update([
            'status' => $request->status,
            'biaya' => $request->biaya,
        ]);

        return redirect()->route('perbaikan.riwayat')->with('success', 'Status dan biaya berhasil diperbarui!');
    }


    public function riwayat(Request $request)
{
    $query = Perbaikan::query();

    if ($request->filled('tanggal')) {
        $query->whereDate('created_at', $request->tanggal);
    }

    if ($request->filled('jenis_perangkat')) {
        $query->where('jenis_perangkat', $request->jenis_perangkat);
    }

    $perbaikans = $query->latest()->get();

    $jenisPerangkatList = Perbaikan::select('jenis_perangkat')
        ->distinct()
        ->pluck('jenis_perangkat');

    return view('perbaikan.riwayat', compact('perbaikans', 'jenisPerangkatList'));
}


}
