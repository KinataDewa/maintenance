@extends('layouts.app')

@section('title', 'Edit Panel')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Edit Data Panel</h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('panel.update', $panel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Panel *</label>
            <input type="text" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   id="nama" 
                   name="nama" 
                   value="{{ old('nama', $panel->nama) }}" 
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
                   value="{{ old('lokasi', $panel->lokasi) }}" 
                   required>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan / Catatan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                      id="keterangan" 
                      name="keterangan">{{ old('keterangan', $panel->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('panel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
