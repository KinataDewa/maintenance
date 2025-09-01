@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-end mb-4">
    <a href="{{ route('rooms.create') }}" class="btn btn-dark rounded-3 shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Ruangan
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
                            <th>Nama Ruangan</th>
                            <th style="width:220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                        <tr>
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                            <td>{{ $room->nama }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('rooms.edit', $room->id) }}" 
                                        class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
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
                                <i class="bi bi-info-circle"></i> Belum ada data ruangan
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
