@extends('layouts.app')

@section('title', 'Daftar Perangkat')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title mb-0">Daftar Perangkat</h3>
        <a href="{{ route('perangkat.create') }}" class="btn btn-dark rounded-3 shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Perangkat
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
                            <th class="text-start">Nama Perangkat</th>
                            <th style="width:220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perangkat as $i => $item)
                            <tr>
                                <td class="text-center fw-semibold">{{ $i + 1 }}</td>
                                <td class="text-start">{{ $item->nama }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('perangkat.edit', $item->id) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('perangkat.destroy', $item->id) }}" method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus perangkat ini?')">
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
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle"></i> Belum ada perangkat
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
