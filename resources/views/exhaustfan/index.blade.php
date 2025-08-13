@extends('layouts.app')

@section('title', 'Daftar Exhaust Fan')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Exhaust Fan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exhaustfan.create') }}" class="btn btn-primary mb-3">Tambah Exhaust Fan Baru</a>

    @if($fans->isEmpty())
        <div class="alert alert-info">Belum ada data exhaust fan.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fans as $index => $fan)
                <tr>
                    <td>{{ $fans->firstItem() + $index }}</td>
                    <td>{{ $fan->nama }}</td>
                    <td>{{ $fan->ruangan }}</td>
                    <td>{{ $fan->merk }}</td>
                    <td>
                        <a href="{{ route('exhaustfan.edit', $fan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('exhaustfan.destroy', $fan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $fans->links() }}
    @endif
</div>
@endsection
