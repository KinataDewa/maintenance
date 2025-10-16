<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Ambil pengaduan baru (hari ini, status "Diproses")
        $pengaduanBaru = Pengaduan::whereDate('created_at', $today)
            ->where('status', 'Diproses')
            ->latest()
            ->get();

        $jumlahPengaduanBaru = $pengaduanBaru->count();

        // Arahkan berdasarkan role
        if ($user->role === 'admin') {
            return view('dashboard.admin', compact('pengaduanBaru', 'jumlahPengaduanBaru'));
        } else {
            return view('dashboard.staff', compact('pengaduanBaru', 'jumlahPengaduanBaru'));
        }
    }
}
