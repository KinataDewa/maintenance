<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengaduan;
use App\Models\MeteranListrik;
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

        // 🔌 Data Meteran Listrik (Grafik)
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

        $labels = $meteranData->pluck('tanggal')->map(function ($t) {
            return Carbon::parse($t)->format('d M');
        });

        $values = $meteranData->pluck('total_kwh');

        // 🔽 Dropdown tenant
        $tenants = Tenant::orderBy('nama')->get();

        return view('dashboard.admin', compact(
            'pengaduanBaru',
            'jumlahPengaduanBaru',
            'labels',
            'values',
            'tenants',
            'tenantId'
        ));
    }
}
