<?php

namespace App\Http\Controllers;

// app/Http/Controllers/ChecklistLogController.php

use App\Models\Checklist;
use App\Models\ChecklistLog;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChecklistLogController extends Controller
{
    public function index()
{
    $logs = ChecklistLog::with(['checklist', 'staff1', 'staff2'])
                ->orderBy('tanggal', 'desc')
                ->get();

    return view('checklist-logs.index', compact('logs'));
}
    public function create()
    {
        $checklists = Checklist::orderBy('jam_mulai')->get();
        $staffList = User::orderBy('name')->get(); // atau model Staff jika ada

        return view('checklist-harian.create', compact('checklists', 'staffList'));
    }

    public function store(Request $request)
    {
        $tanggal = Carbon::today()->toDateString();

        foreach ($request->input('checklist_logs') as $log) {
            ChecklistLog::updateOrCreate(
                [
                    'checklist_id' => $log['checklist_id'],
                    'tanggal' => $tanggal
                ],
                [
                    'staff_1_id' => $log['staff_1_id'] ?? null,
                    'staff_2_id' => $log['staff_2_id'] ?? null,
                    'status' => $log['status'] ?? 'belum',
                ]
            );
        }

        return redirect()->route('checklist-harian.create')->with('success', 'Checklist harian berhasil dikirim.');
    }
}
