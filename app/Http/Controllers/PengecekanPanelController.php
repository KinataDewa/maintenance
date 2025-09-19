<?php

namespace App\Http\Controllers;

use App\Models\PengecekanPanel;
use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanPanelController extends Controller
{
    public function create()
    {
        $panels = Panel::all();
        return view('pengecekan_panels.create', compact('panels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'panel_id' => 'required|exists:panels,id',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $fotoPaths[] = $foto->store('pengecekan_panel', 'public');
            }
        }

        PengecekanPanel::create([
            'panel_id' => $request->panel_id,
            'pengecekan' => $request->input('pengecekan', []),
            'foto' => $fotoPaths,
            'catatan' => $request->catatan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data pengecekan panel berhasil disimpan.');
    }

    public function index()
    {
        $riwayat = PengecekanPanel::with(['panel', 'user'])->latest()->paginate(10);
        return view('pengecekan_panels.riwayat', compact('riwayat'));
    }
}
