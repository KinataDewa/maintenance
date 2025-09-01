<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PompaUnit;
use App\Models\PompaMaintenance;
use Illuminate\Support\Facades\Auth;

class PompaMaintenanceController extends Controller
{
    // Tampilkan form perawatan
    public function create()
    {
        $pompas = PompaUnit::all();
        return view('pompa_maintenance.create', compact('pompas'));
    }

    // Simpan data perawatan
    public function store(Request $request)
    {
        $request->validate([
            'pompa_unit_id' => 'required|exists:pompa_units,id',
            'voltase' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'tekanan' => 'nullable|numeric',
            'oli' => 'nullable|in:bocor,tidak',
            'suara' => 'nullable|in:halus,kasar',
        ]);

        PompaMaintenance::create([
            'pompa_unit_id' => $request->pompa_unit_id,
            'user_id' => Auth::id(),
            'voltase' => $request->voltase,
            'suhu' => $request->suhu,
            'tekanan' => $request->tekanan,
            'oli' => $request->oli,
            'suara' => $request->suara,
        ]);

        return redirect()->route('pompa.maintenance.create')->with('success', 'Perawatan pompa berhasil disimpan.');
    }

    // Riwayat perawatan
    public function riwayat(Request $request)
    {
        // Ambil semua pompa untuk dropdown filter
        $pompas = \App\Models\PompaUnit::all();

        // Ambil data maintenance
        $query = \App\Models\PompaMaintenance::with(['pompa', 'user']);

        // Filter berdasarkan pompa jika ada
        if ($request->pompa_unit_id) {
            $query->where('pompa_unit_id', $request->pompa_unit_id);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->tanggal) {
            $query->whereDate('tanggal_perawatan', $request->tanggal);
        }

        $logs = $query->orderBy('tanggal_perawatan', 'desc')->get();

        return view('pompa_maintenance.riwayat', [
            'logs' => $logs,
            'pompas' => $pompas,
        ]);
    }
}
