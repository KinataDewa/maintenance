<?php

namespace App\Http\Controllers;

use App\Models\MesinStpLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MesinStpController extends Controller
{
    // Form create
    public function create()
    {
        return view('stp.mesin.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'mesin' => 'required|in:Mesin STP 1,Mesin STP 2',
            'oli' => 'required|string',
            'vanbelt' => 'required|string',
            'suhu' => 'required|numeric',
            'suara' => 'required|in:Halus,Bising Ringan,Bising Berat',
            'catatan' => 'nullable|string',
        ]);

        MesinStpLog::create([
            'mesin' => $request->mesin,
            'oli' => $request->oli,
            'vanbelt' => $request->vanbelt,
            'suhu' => $request->suhu,
            'suara' => $request->suara,
            'catatan' => $request->catatan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('mesin-stp.create')->with('success', 'Data Mesin STP berhasil disimpan.');
    }

    // Riwayat dengan filter
    public function riwayat(Request $request)
    {
        // 1. Validasi filter
        $request->validate([
            'mesin' => 'nullable|in:Mesin STP 1,Mesin STP 2',
            'tanggal' => 'nullable|date',
        ], [
            'mesin.in' => 'Pilihan mesin tidak valid.',
            'tanggal.date' => 'Format tanggal tidak valid.',
        ]);

        // 2. Query dasar
        $query = MesinStpLog::with('user')->latest();

        // 3. Filter berdasarkan mesin
        if ($request->filled('mesin')) {
            $query->where('mesin', $request->mesin);
        }

        // 4. Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $tanggal = Carbon::parse($request->tanggal)->startOfDay();
            $query->whereDate('created_at', $tanggal);
        }

        // 5. Ambil data hasil filter
        $logs = $query->get();

        // 6. Kirim data ke view
        return view('stp.mesin.riwayat', compact('logs'));
    }
}
