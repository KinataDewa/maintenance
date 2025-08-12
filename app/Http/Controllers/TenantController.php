<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'lantaiTenant' => 'nullable|string|max:255',
        'ruanganTenant' => 'nullable|string|max:255',
    ]);

    Tenant::create([
        'nama' => $request->nama,
        'lantaiTenant' => $request->lantaiTenant,
        'ruanganTenant' => $request->ruanganTenant,
    ]);

    return redirect()->route('tenants.index')->with('success', 'Tenant berhasil ditambahkan');
}

    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'lantaiTenant' => 'nullable|string|max:255',
        'ruanganTenant' => 'nullable|string|max:255',
    ]);

    $tenant->update([
        'nama' => $request->nama,
        'lantaiTenant' => $request->lantaiTenant,
        'ruanganTenant' => $request->ruanganTenant,
    ]);

    return redirect()->route('tenants.index')->with('success', 'Tenant berhasil diperbarui');
}

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Tenant berhasil dihapus.');
    }
}
