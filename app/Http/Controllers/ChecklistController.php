<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ChecklistLog;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::with('staff')->get();
        $staffList = Staff::all();
        $tanggal = Carbon::now()->translatedFormat('l, d F Y');

        return view('checklist.index', compact('checklists', 'staffList', 'tanggal'));
    }

    public function update(Request $request, $id)
    {
        $checklist = Checklist::findOrFail($id);

        // Validasi
        $request->validate([
            'status' => 'required|in:belum,progres,selesai',
            'staff_ids.*' => 'nullable|exists:staff,id|distinct'
        ]);

        $checklist->status = $request->status;
        $checklist->save();

        $staffIds = array_filter($request->staff_ids ?? []);
        $checklist->staff()->sync($staffIds);

        return back()->with('success', 'Checklist berhasil diperbarui.');
    }

    // ✅ Method untuk reset semua checklist
    public function resetAll(Request $request)
    {
        $checklists = Checklist::all();

        foreach ($checklists as $checklist) {
            // Reset status ke 'belum'
            $checklist->status = 'belum';
            $checklist->save();

            // Kosongkan relasi staff
            $checklist->staff()->detach();
        }

        return redirect()->route('checklist.index')->with('success', 'Semua checklist berhasil di-reset.');
    }
}
