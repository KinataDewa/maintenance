@extends('layouts.app')

@section('title', 'Edit AC')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Edit Data AC</h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('acs.update', $ac->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama AC *</label>
            <input type="text" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   id="nama" 
                   name="nama" 
                   value="{{ old('nama', $ac->nama) }}" 
                   required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan *</label>
            <input type="text" 
                   class="form-control @error('ruangan') is-invalid @enderror" 
                   id="ruangan" 
                   name="ruangan" 
                   value="{{ old('ruangan', $ac->ruangan) }}" 
                   required>
            @error('ruangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nomor" class="form-label">Nomor *</label>
            <input type="text" 
                   class="form-control @error('nomor') is-invalid @enderror" 
                   id="nomor" 
                   name="nomor" 
                   value="{{ old('nomor', $ac->nomor) }}" 
                   required>
            @error('nomor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk *</label>
            <input type="text" 
                   class="form-control @error('merk') is-invalid @enderror" 
                   id="merk" 
                   name="merk" 
                   value="{{ old('merk', $ac->merk) }}" 
                   required>
            @error('merk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('acs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
