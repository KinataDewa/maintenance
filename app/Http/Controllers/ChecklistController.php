<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    public function index()
    {
        $perangkat = Perangkat::with(['checklists' => function ($query) {
            $query->latest();
        }])->get();

        return view('checklist.index', compact('perangkat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perangkat_id' => 'required|exists:perangkat,id',
            'aksi' => 'required|in:on,off',
        ]);

        Checklist::create([
    'perangkat_id' => $request->perangkat_id,
    'user_id' => Auth::id(),
    'aksi' => $request->aksi,
    'tanggal' => now()->toDateString(),
    'jam' => now()->toTimeString(), 
]);

        return redirect()->route('checklist.index');
    }

    public function riwayat()
{
    $groupedChecklists = Checklist::with(['perangkat', 'user'])
        ->orderBy('tanggal', 'desc')
        ->orderBy('jam', 'asc')
        ->get()
        ->groupBy('tanggal');

    return view('checklist.riwayat', compact('groupedChecklists'));
}
}
