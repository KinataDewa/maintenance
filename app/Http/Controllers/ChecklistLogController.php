<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistLog;
use Carbon\Carbon;

class ChecklistLogController extends Controller
{
public function store(Request $request)
{
    $tanggal = Carbon::today('Asia/Jakarta')->toDateString();
    $checklists = Checklist::all();
    $existingLogs = ChecklistLog::where('tanggal', $tanggal)->pluck('checklist_id')->toArray();

    foreach ($checklists as $item) {
        if (in_array($item->id, $existingLogs)) {
            continue;
        }

        if (empty($item->status)) {
            continue;
        }

        ChecklistLog::create([
            'checklist_id' => $item->id,
            'status' => $item->status,
            'tanggal' => $tanggal,
            'user_id' => null // karena login belum aktif
        ]);
    }

    Checklist::query()->update(['status' => 'belum']);

    return redirect()->back()->with('success', 'Checklist disimpan dan direset.');
}


    public function riwayat()
{
    $riwayat = ChecklistLog::with(['checklist'])
        ->orderBy('tanggal', 'desc')
        ->orderBy('checklist_id')
        ->get()
        ->groupBy('tanggal');

    return view('checklist.riwayat', compact('riwayat'));
}


    public function destroy($id)
{
    $log = ChecklistLog::findOrFail($id);
    $log->delete();

    return redirect()->back()->with('success', 'Checklist berhasil dihapus.');
}


}
