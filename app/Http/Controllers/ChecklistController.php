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

    public function updateStatus(Request $request, $id)
    {
        $checklist = Checklist::findOrFail($id);
        $checklist->status = $request->status;
        $checklist->save();
        return back();
    }

    public function updateStaff(Request $request, $id)
    {
        $checklist = Checklist::findOrFail($id);

        // Pastikan hanya maksimal 2 staff dan tidak boleh sama
        $staffIds = array_filter($request->staff_ids ?? []);
        if (count($staffIds) !== count(array_unique($staffIds))) {
            return back()->with('error', 'Staff 1 dan Staff 2 tidak boleh sama.');
        }

        $checklist->staff()->sync($staffIds);

        return back()->with('success', 'Staff berhasil diperbarui.');
    }
}
