<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PompaUnit;

class PompaUnitController extends Controller
{
    public function index()
    {
        $pompas = PompaUnit::all();
        return view('pompa.index', compact('pompas'));
    }

    public function create()
    {
        return view('pompa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pompa' => 'required|string|max:255',
        ]);

        PompaUnit::create($request->all());

        return redirect()->route('pompa.index')->with('success', 'Pompa berhasil ditambahkan.');
    }

    public function edit($id)
{
    $pompa = PompaUnit::findOrFail($id);
    return view('pompa.edit', compact('pompa'));
}

public function update(Request $request, $id)
{
    $pompa = PompaUnit::findOrFail($id);
    $pompa->update($request->all());
    return redirect()->route('pompa.index')->with('success', 'Pompa berhasil diupdate.');
}

public function destroy($id)
{
    $pompa = PompaUnit::findOrFail($id);
    $pompa->delete();
    return redirect()->route('pompa.index')->with('success', 'Pompa berhasil dihapus.');
}

}