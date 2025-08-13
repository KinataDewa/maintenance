<?php

namespace App\Http\Controllers;

use App\Models\ExhaustFanLog;
use App\Models\ExhaustFan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExhaustFanLogController extends Controller
{
    public function create()
    {
        $exhaustFans = ExhaustFan::all();
        return view('exhaustfanlogs.create', compact('exhaustFans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exhaust_fan_id' => 'required|exists:exhaust_fans,id',
            'status' => 'required|in:normal,tidak normal',
            'perawatan' => 'required|array',
            'perawatan.*' => 'string',
            'foto_pembersihan' => 'nullable|image|max:5120', // max 5MB
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->only('exhaust_fan_id', 'status', 'keterangan');
        // Simpan perawatan sebagai string (implode)
        $data['perawatan'] = implode(',', $request->perawatan);
        $data['tanggal'] = date('Y-m-d');
        $data['jam'] = date('H:i:s');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto_pembersihan')) {
            $path = $request->file('foto_pembersihan')->store('exhaustfan/photos', 'public');
            $data['foto_pembersihan'] = $path;
        }

        ExhaustFanLog::create($data);

        return redirect()->route('exhaustfanlogs.create')->with('success', 'Data log exhaust fan berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $query = ExhaustFanLog::with('exhaustFan', 'user')->orderBy('created_at', 'desc');

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $logs = $query->paginate(15);

        return view('exhaustfanlogs.riwayat', compact('logs'));
    }
}
