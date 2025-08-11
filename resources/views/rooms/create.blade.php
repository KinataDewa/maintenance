@extends('layouts.app')

@section('title', 'Tambah Ruangan')

@section('content')
<div class="container py-4">
    <h2 class="page-title">Tambah Ruangan</h2>

    <form action="{{ route('rooms.store') }}" method="POST" class="bg-white p-4 rounded-3 shadow-sm" style="max-width: 500px;">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Ruangan</label>
            <input type="text" name="nama" class="form-control rounded-2" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary rounded-2">← Kembali</a>
            <button type="submit" class="btn btn-warning rounded-2">Simpan</button>
        </div>
    </form>
</div>
@endsection
