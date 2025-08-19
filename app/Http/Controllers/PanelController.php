<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panel;

class PanelController extends Controller
{
    public function index()
    {
        $panels = Panel::all(); // ambil semua data panel
        return view('panel.index', compact('panels'));
    }

    public function create()
    {
        return view('panel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Panel::create($request->all());
        return redirect()->route('panel.index')->with('success', 'Panel berhasil ditambahkan.');
    }

    public function edit(Panel $panel)
    {
        return view('panel.edit', compact('panel'));
    }

    public function update(Request $request, Panel $panel)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $panel->update($request->all());
        return redirect()->route('panel.index')->with('success', 'Panel berhasil diupdate.');
    }

    public function destroy(Panel $panel)
    {
        $panel->delete();
        return redirect()->route('panel.index')->with('success', 'Panel berhasil dihapus.');
    }
}
