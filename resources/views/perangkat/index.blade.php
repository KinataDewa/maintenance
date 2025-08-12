@extends('layouts.app')

@section('title', 'Daftar Perangkat')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Perangkat</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('perangkat.create') }}" class="btn btn-warning mb-3 rounded-3">
        + Tambah Perangkat
    </a>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Nama Perangkat</th>
                    <th style="width:200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perangkat as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <div class="d-grid d-md-flex justify-content-center gap-2">
                                <a href="{{ route('perangkat.edit', $item->id) }}" 
                                   class="btn btn-outline-primary rounded-2 text-center"
                                   style="min-width: 100px; height: 38px;">
                                    Edit
                                </a>

                                <form action="{{ route('perangkat.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus perangkat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger rounded-2 text-center"
                                            style="min-width: 100px; height: 38px;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada perangkat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
