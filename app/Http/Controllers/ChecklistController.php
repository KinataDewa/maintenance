<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Staff;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::with('staff')->get();
        $staffList = Staff::all();

        return view('checklist.index', compact('checklists', 'staffList'));
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

}
