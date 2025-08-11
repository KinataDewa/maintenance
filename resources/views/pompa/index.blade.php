@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Pompa Air</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('pompa.create') }}" class="btn btn-warning mb-3 rounded-3">+ Tambah Pompa</a>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pompa</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Kapasitas</th>
                    <th>Tekanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pompas as $pompa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pompa->nama_pompa }}</td>
                    <td>{{ $pompa->merk ?? '-' }}</td>
                    <td>{{ $pompa->tipe ?? '-' }}</td>
                    <td>{{ $pompa->kapasitas ?? '-' }}</td>
                    <td>{{ $pompa->tekanan ?? '-' }}</td>
                    <td>
                    <div class="d-grid d-md-flex justify-content-center gap-2">
                        <a href="{{ route('pompa.edit', $pompa->id) }}" 
                        class="btn btn-outline-primary rounded-2 text-center"
                        style="min-width: 120px; width: 120px; height: 38px;">
                            Edit
                        </a>

                        <form action="{{ route('pompa.destroy', $pompa->id) }}" method="POST" 
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
                    <td colspan="7" class="text-center text-muted">Belum ada data pompa</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
