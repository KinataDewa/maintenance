@extends('layouts.app')

@section('title', 'Tambah Pompa')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Tambah Pompa</h3>

    <form action="{{ route('pompa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_pompa" class="form-label">Nama Pompa *</label>
            <input type="text" class="form-control @error('nama_pompa') is-invalid @enderror" id="nama_pompa" name="nama_pompa" required>
            @error('nama_pompa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-select" id="jenis" name="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="STP">STP</option>
                <option value="PDAM">PDAM</option>
                <option value="Hydrant">Hydrant</option>
                <option value="Hydrant">Diesel</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk">
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="text" class="form-control" id="tipe" name="tipe">
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="text" class="form-control" id="kapasitas" name="kapasitas">
        </div>

        <div class="mb-3">
            <label for="tekanan" class="form-label">Tekanan</label>
            <input type="text" class="form-control" id="tekanan" name="tekanan">
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('pompa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
