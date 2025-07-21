<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeteranListrik;
use App\Models\Tenant;
use Carbon\Carbon;
use App\Exports\MeteranExport;
use Maatwebsite\Excel\Facades\Excel;

class MeteranListrikController extends Controller
{
    public function create()
    {
        $tenants = Tenant::all();
        return view('meteran.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'kwh' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Simpan foto
        $fotoPath = $request->file('foto')->store('meteran_foto', 'public');

        // Simpan ke database
        MeteranListrik::create([
            'tenant_id' => $request->tenant_id,
            'kwh' => $request->kwh,
            'foto' => $fotoPath,
            'deskripsi' => $request->deskripsi,
            'tanggal' => Carbon::now('Asia/Jakarta')->toDateString(),
            'jam' => Carbon::now('Asia/Jakarta')->format('H:i:s'),
        ]);

        return redirect()->route('meteran.create')->with('success', 'Data meteran berhasil disimpan!');
    }

    public function riwayat(Request $request)
    {
        $query = MeteranListrik::with('tenant')->latest();

        if ($request->filled('tenant_id')) {
            $query->where('tenant_id', $request->tenant_id);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_input', $request->tanggal);
        }

        $riwayat = $query->get();
        $tenants = Tenant::all();

        return view('meteran.riwayat', compact('riwayat', 'tenants'));
    }
    public function export(Request $request)
{
    $tenant_id = $request->tenant_id;
    $tanggal = $request->tanggal;

    return Excel::download(new MeteranExport($tenant_id, $tanggal), 'meteran_listrik.xlsx');
}
}
