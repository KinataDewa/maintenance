<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChecklistLog;

class RiwayatController extends Controller
{
    public function index()
    {
        return view('riwayat.index');
    }

    public function checklist()
    {
        $riwayat = ChecklistLog::with(['checklist', 'staff'])->orderBy('tanggal', 'desc')->get();
        return view('checklist.riwayat', compact('riwayat'));
    }
}
