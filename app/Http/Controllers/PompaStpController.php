<?php

namespace App\Http\Controllers;

use App\Models\PompaStpLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PompaStpController extends Controller
{
    // Halaman form create
    public function create()
    {
        return view('pompa-stp.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'pompa'    => 'required|in:Pompa STP 1,Pompa STP 2',
            'voltase'  => 'required|numeric',
            'suhu'     => 'required|numeric',
            'oli'      => 'required|in:Normal,Kurang,Kotor',
            'pulling'  => 'required|in:Baik,Perlu Dicek,Rusak',
            'motor'    => 'required|in:Normal,Overheat,Bergetar,Tidak Berfungsi',
        ]);

        PompaStpLog::create([
            'pompa'    => $request->pompa,
            'voltase'  => $request->voltase,
            'suhu'     => $request->suhu,
            'oli'      => $request->oli,
            'pulling'  => $request->pulling,
            'motor'    => $request->motor,
            'user_id'  => Auth::id(), // otomatis ambil user yang sedang login
        ]);

    return redirect()->route('pompa-stp.create')->with('success', 'Data Pompa STP berhasil disimpan.');
    }

    // Tampilkan riwayat
    public function riwayat()
    {
        $logs = PompaStpLog::with('user')->latest()->paginate(10);
        return view('pompa-stp.riwayat', compact('logs'));
    }
}
