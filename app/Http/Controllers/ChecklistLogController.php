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
        $checklists = Checklist::with('staff')->get();

        foreach ($checklists as $item) {
            // Skip jika belum dipilih status atau staff
            if (empty($item->status) || $item->staff->isEmpty()) {
                continue;
            }

            // Simpan ke checklist_logs
            $log = ChecklistLog::create([
                'checklist_id' => $item->id,
                'status' => $item->status,
                'tanggal' => $tanggal
            ]);

            // Simpan staff ke pivot log
            $staffIds = $item->staff->pluck('id')->toArray();
            $log->staff()->sync($staffIds);
        }

        return redirect()->back()->with('success', 'Checklist harian berhasil disimpan.');
    }
    public function riwayat()
{
    // Ambil data log, dikelompokkan per tanggal
    $riwayat = ChecklistLog::with(['checklist', 'staff'])
        ->orderBy('tanggal', 'desc')
        ->get()
        ->groupBy('tanggal');

    return view('checklist.riwayat', compact('riwayat'));
}
}
