<?php

namespace App\Http\Controllers;

use App\Models\PompaLog;
use App\Models\PompaUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PompaLogController extends Controller
{
    public function create()
    {
        $pompaUnits = PompaUnit::all();
        return view('pompa.log-form', compact('pompaUnits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pompa_unit_id' => 'required|exists:pompa_units,id',
            'meteran' => 'nullable|string|max:255',
            'status' => 'required|in:Baik,Perbaikan,Rusak',
            'foto' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pompa', 'public');
        }

        PompaLog::create([
            'pompa_unit_id' => $request->pompa_unit_id,
            'meteran' => $request->meteran,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('pompa.logs.create')->with('success', 'Log pompa berhasil disimpan.');
    }

    public function riwayat()
    {
        $logs = PompaLog::with(['pompaUnit', 'user'])->latest()->get();

        return view('pompa.logs.riwayat', compact('logs'));
    }
}