<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengaduan;
use App\Models\MeteranListrik;
use App\Models\MeteranListrikInduk;
use App\Models\Tenant;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        // 🔔 Pengaduan baru hari ini
        $pengaduanBaru = Pengaduan::whereDate('created_at', $today)
            ->where('status', 'Diproses')
            ->latest()
            ->get();

        $jumlahPengaduanBaru = $pengaduanBaru->count();

        // 🧩 Filter Tenant
        $tenantId = $request->input('tenant_id');

        // ⚡ Grafik Pemakaian Listrik (Per Tenant)
        $meteranData = MeteranListrik::select(
                DB::raw('DATE(waktu_input) as tanggal'),
                DB::raw('SUM(kwh) as total_kwh')
            )
            ->when($tenantId, function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            })
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labels = $meteranData->pluck('tanggal')->map(fn($t) => Carbon::parse($t)->format('d M'));
        $values = $meteranData->pluck('total_kwh');

        // ⚙️ Grafik Induk PLN (MeteranListrikInduk)
        $indukData = MeteranListrikInduk::orderBy('tanggal', 'asc')->get();

        $labelsInduk = $indukData->pluck('tanggal')->map(fn($t) => Carbon::parse($t)->format('d M'));
        $kwhData = $indukData->pluck('kwh');
        $kvarData = $indukData->pluck('kvar');
        $cosphiData = $indukData->pluck('cosphi');
        $wbpData = $indukData->pluck('wbp');
        $lwbpData = $indukData->pluck('lwbp');

        // 🔽 Dropdown tenant
        $tenants = Tenant::orderBy('nama')->get();

        // 🧭 Pilih view sesuai role
        if ($user->role === 'admin') {
            return view('dashboard.admin', compact(
                'pengaduanBaru',
                'jumlahPengaduanBaru',
                'labels',
                'values',
                'labelsInduk',
                'kwhData',
                'kvarData',
                'cosphiData',
                'wbpData',
                'lwbpData',
                'tenants',
                'tenantId'
            ));
        } else {
            return view('dashboard.staff', compact(
                'pengaduanBaru',
                'jumlahPengaduanBaru',
                'labels',
                'values',
                'labelsInduk',
                'kwhData',
                'kvarData',
                'cosphiData',
                'wbpData',
                'lwbpData',
                'tenants',
                'tenantId'
            ));
        }
    }
}
