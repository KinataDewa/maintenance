@extends('layouts.app')

@section('title', 'Tambah Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Tambah Exhaust Fan</h3>

    <form action="{{ route('exhaustfan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Exhaust Fan *</label>
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

        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <input 
                type="text" 
                class="form-control @error('ruangan') is-invalid @enderror" 
                id="ruangan" 
                name="ruangan" 
                value="{{ old('ruangan') }}"
            >
            @error('ruangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input 
                type="text" 
                class="form-control @error('merk') is-invalid @enderror" 
                id="merk" 
                name="merk" 
                value="{{ old('merk') }}"
            >
            @error('merk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('exhaustfan.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection
