@extends('layouts.app')

@section('title', 'Tambah Panel')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Tambah Panel</h3>

    <form action="{{ route('panel.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Panel *</label>
            <input type="text" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   id="nama" 
                   name="nama" 
                   value="{{ old('nama') }}" 
                   required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi *</label>
            <input type="text" 
                   class="form-control @error('lokasi') is-invalid @enderror" 
                   id="lokasi" 
                   name="lokasi" 
                   value="{{ old('lokasi') }}" 
                   required>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan / Catatan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                      id="keterangan" 
                      name="keterangan">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('panel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
