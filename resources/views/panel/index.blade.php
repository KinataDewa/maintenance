@extends('layouts.app')

@section('title', 'Daftar Panel')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Panel</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('panel.create') }}" class="tambahDaftar mb-3">
        + Tambah Panel
    </a>

    <div class="table-responsive">
        <table class="table table-bordered text-start">
            <thead class="table-dark text-center">
                <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Nama Panel</th>
                    <th class="text-start">Lokasi</th>
                    <th class="text-start">Keterangan / Catatan</th>
                    <th class="text-start">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($panels as $panel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $panel->nama }}</td>
                    <td>{{ $panel->lokasi }}</td>
                    <td>{{ $panel->keterangan ?? '-' }}</td>
                    <td>
                        <div class="d-grid d-md-flex justify-content-start gap-2"> <!-- tombol di kiri -->
                            <a href="{{ route('panel.edit', $panel->id) }}" 
                               class="btn btn-outline-primary rounded-2 text-center"
                               style="min-width: 120px; width: 120px; height: 38px;">
                                Edit
                            </a>

                            <form action="{{ route('panel.destroy', $panel->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger rounded-2 text-center"
                                        style="min-width: 120px; width: 120px; height: 38px;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-start text-muted">Belum ada panel</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
