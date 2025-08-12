@extends('layouts.app')

@section('title', 'Tambah Tenant')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Tambah Tenant</h3>

    <form action="{{ route('tenants.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Tenant *</label>
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
    <label for="lantaiTenant" class="form-label">Lantai</label>
    <input type="text" name="lantaiTenant" id="lantaiTenant" class="form-control" value="{{ old('lantaiTenant') }}">
</div>

<div class="mb-3">
    <label for="ruanganTenant" class="form-label">Ruangan</label>
    <input type="text" name="ruanganTenant" id="ruanganTenant" class="form-control" value="{{ old('ruanganTenant') }}">
</div>


        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
