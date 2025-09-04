@extends('layouts.app')

@section('title', 'Daftar Tenant')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title mb-0">Daftar Tenant</h3>
        <a href="{{ route('tenants.create') }}" class="btn btn-dark rounded-3 shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Tenant
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle mb-0 border-secondary-subtle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Tenant</th>
                            <th style="width:120px;">Lantai</th>
                            <th style="width:140px;">Ruangan</th>
                            <th style="width:220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tenants as $tenant)
                        <tr>
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                            <td>{{ $tenant->nama }}</td>
                            <td class="text-center">{{ $tenant->lantaiTenant ?? '-' }}</td>
                            <td class="text-center">{{ $tenant->ruanganTenant ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('tenants.edit', $tenant->id) }}" 
                                        class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus tenant ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger rounded-3 px-3">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle"></i> Belum ada tenant
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
