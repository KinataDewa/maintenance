@extends('layouts.app')

@section('title', 'Edit Pompa')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Edit Data Pompa</h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pompa.update', $pompa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pompa" class="form-label">Nama Pompa</label>
            <input type="text" class="form-control" id="nama_pompa" name="nama_pompa" value="{{ old('nama_pompa', $pompa->nama_pompa) }}" required>
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" value="{{ old('merk', $pompa->merk) }}">
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="text" class="form-control" id="tipe" name="tipe" value="{{ old('tipe', $pompa->tipe) }}">
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $pompa->kapasitas) }}">
        </div>

        <div class="mb-3">
            <label for="tekanan" class="form-label">Tekanan</label>
            <input type="text" class="form-control" id="tekanan" name="tekanan" value="{{ old('tekanan', $pompa->tekanan) }}">
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('pompa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
