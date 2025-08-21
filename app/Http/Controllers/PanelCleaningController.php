<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\PanelCleaningLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelCleaningController extends Controller
{
    public function create()
    {
        $panels = Panel::orderBy('id','desc')->get();
        return view('panel_cleaning.create', compact('panels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'panel_id'     => ['required','exists:panels,id'],
            'catatan'      => ['nullable','string','max:2000'],
            'foto_before'  => ['nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
            'foto_after'   => ['nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
            'debu_bersih'        => ['nullable','boolean'],
            'luar_bersih'        => ['nullable','boolean'],
            'dalam_rapi'         => ['nullable','boolean'],
            'tidak_ada_sampah'   => ['nullable','boolean'],
        ]);

        $fotoBeforePath = $request->hasFile('foto_before')
            ? $request->file('foto_before')->store('panel_cleaning', 'public')
            : null;

        $fotoAfterPath = $request->hasFile('foto_after')
            ? $request->file('foto_after')->store('panel_cleaning', 'public')
            : null;

        $now = now();

        PanelCleaningLog::create([
            'panel_id'  => $request->panel_id,
            'user_id'   => Auth::id(),

            'debu_bersih'       => $request->boolean('debu_bersih'),
            'luar_bersih'       => $request->boolean('luar_bersih'),
            'dalam_rapi'        => $request->boolean('dalam_rapi'),
            'tidak_ada_sampah'  => $request->boolean('tidak_ada_sampah'),

            'catatan'     => $request->catatan,
            'foto_before' => $fotoBeforePath,
            'foto_after'  => $fotoAfterPath,

            'tanggal' => $now->toDateString(),
            'jam'     => $now->format('H:i:s'),
        ]);

        return redirect()->route('panel-cleaning.create')->with('success', 'Data cleaning panel berhasil disimpan!');
    }

    public function riwayat(Request $request)
    {
        // Ambil data panel untuk dropdown filter
        $panels = Panel::orderBy('id','desc')->get();

        // Query dasar
        $query = PanelCleaningLog::with(['panel','user']);

        // Filter panel
        if ($request->filled('panel_id')) {
            $query->where('panel_id', $request->panel_id);
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Ambil hasil
        $logs = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('panel_cleaning.riwayat', compact('logs', 'panels'));
    }

    // optional → biar tombol reset tidak error
    public function index()
    {
        return redirect()->route('panel-cleaning.riwayat');
    }
}
