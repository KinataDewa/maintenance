@extends('layouts.app')

@section('title', 'Daftar Panel')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title mb-0">Daftar Panel</h3>
        <a href="{{ route('panel.create') }}" class="btn btn-primary rounded-3 shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Panel
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
                            <th>Nama Panel</th>
                            <th>Lokasi</th>
                            <th>Keterangan / Catatan</th>
                            <th style="width:220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($panels as $panel)
                        <tr>
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                            <td>{{ $panel->nama }}</td>
                            <td>{{ $panel->lokasi }}</td>
                            <td>{{ $panel->keterangan ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('panel.edit', $panel->id) }}" 
                                        class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('panel.destroy', $panel->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                <i class="bi bi-info-circle"></i> Belum ada data panel
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
