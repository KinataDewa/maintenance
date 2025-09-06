<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\PanelInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelInspectionController extends Controller
{
    /**
     * Menampilkan form pengecekan panel
     */
    public function create()
    {
        $panels = Panel::all();
        return view('panel_inspections.create', compact('panels'));
    }

    /**
     * Menyimpan data pengecekan panel
     */
    public function store(Request $request)
    {
        $request->validate([
            'panel_id' => 'required|exists:panels,id',
            'suhu_mcb' => 'nullable|numeric',
            'suhu_terminal' => 'nullable|numeric',
        ]);

        PanelInspection::create([
            'panel_id' => $request->panel_id,
            'user_id' => Auth::id(),
            'kabel_terkupas' => $request->kabel_terkupas ?? 0,
            'mcb_rusak' => $request->mcb_rusak ?? 0,
            'panel_bersih' => $request->panel_bersih ?? 0,
            'baut_terminal' => $request->baut_terminal ?? 0,
            'grounding_baik' => $request->grounding_baik ?? 0,
            'suhu_mcb' => $request->suhu_mcb,
            'suhu_terminal' => $request->suhu_terminal,
            'mcb_normal' => $request->mcb_normal ?? 0,
            'lampu_indikator' => $request->lampu_indikator ?? 0,
            'panel_tertutup' => $request->panel_tertutup ?? 0,
            'catatan' => $request->catatan,
        ]);


        return redirect()->route('panel-inspections.create')->with('success', 'Pengecekan panel berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $panels = Panel::all();

        $riwayat = PanelInspection::with('panel', 'user')
            ->when($request->panel_id, function($query) use ($request) {
                $query->where('panel_id', $request->panel_id);
            })
            ->when($request->tanggal, function($query) use ($request) {
                $query->whereDate('created_at', $request->tanggal);
            })
            ->latest()
            ->get();

        return view('panel_inspections.riwayat', compact('riwayat', 'panels'));
    }

}
