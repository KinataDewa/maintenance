@extends('layouts.app')

@section('title', 'Daftar Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Exhaust Fan</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('exhaustfan.create') }}" class="btn btn-warning mb-3 rounded-3">+ Tambah Exhaust Fan</a>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Exhaust Fan</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fans as $fan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fan->nama }}</td>
                    <td>{{ $fan->ruangan ?? '-' }}</td>
                    <td>{{ $fan->merk ?? '-' }}</td>
                    <td>
                        <div class="d-grid d-md-flex justify-content-center gap-2">
                            <a href="{{ route('exhaustfan.edit', $fan->id) }}" 
                                class="btn btn-outline-primary rounded-2 text-center"
                                style="min-width: 120px; width: 120px; height: 38px;">
                                Edit
                            </a>

                            <form action="{{ route('exhaustfan.destroy', $fan->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus exhaust fan ini?')">
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
                    <td colspan="5" class="text-center text-muted">Belum ada data exhaust fan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
