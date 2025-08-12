@extends('layouts.app')

@section('title', 'Tambah Perangkat')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Tambah Perangkat</h3>

    <form action="{{ route('perangkat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Perangkat *</label>
            <input 
                type="text" 
                class="form-control @error('nama') is-invalid @enderror" 
                id="nama" 
                name="nama" 
                value="{{ old('nama') }}" 
                required
            >
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
