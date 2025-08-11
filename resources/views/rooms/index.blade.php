@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Ruangan</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('rooms.create') }}" class="btn btn-warning mb-3 rounded-3">+ Tambah Ruangan</a>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $room->nama }}</td>
                    <td>
                        <div class="d-grid d-md-flex justify-content-center gap-2">
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="btn btn-outline-primary rounded-2 text-center"
                               style="min-width: 120px; height: 38px;">
                                Edit
                            </a>

                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger rounded-2 text-center"
                                        style="min-width: 120px; height: 38px;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-muted">Belum ada data ruangan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
