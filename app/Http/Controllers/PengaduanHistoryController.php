<?php

namespace App\Http\Controllers;

use App\Models\PengaduanHistory;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanHistoryController extends Controller
{
    public function index(Request $request)
{
    $query = PengaduanHistory::with(['editor', 'pengaduan'])->latest();

    // Filter history berdasarkan pengaduan_id
    if ($request->pengaduan_id) {
        $query->where('pengaduan_id', $request->pengaduan_id);
    }

    $histories = $query->get();

    return view('pengaduan.history', compact('histories'));
}

}
