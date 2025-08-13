<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomTemperatureLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomTemperatureLogController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('temperature.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'titik_1' => 'required|numeric',
            'titik_2' => 'required|numeric',
            'titik_3' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('room_id', 'titik_1', 'titik_2', 'titik_3');
        $data['user_id'] = Auth::id();
        $data['waktu_cek'] = now();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('temperature_photos', 'public');
        }

        RoomTemperatureLog::create($data);

        return redirect()->route('temperature.create')->with('success', 'Data suhu berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $rooms = Room::all();

        $logs = RoomTemperatureLog::with('room', 'user')
            ->when($request->room_id, function($query) use ($request) {
                $query->where('room_id', $request->room_id);
            })
            ->when($request->tanggal, function($query) use ($request) {
                $query->whereDate('waktu_cek', $request->tanggal);
            })
            ->latest()
            ->get();

        return view('temperature.riwayat', compact('logs', 'rooms'));
    }
}

