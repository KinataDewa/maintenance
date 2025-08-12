@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Edit Data Tenant</h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Tenant *</label>
            <input 
                type="text" 
                class="form-control @error('nama') is-invalid @enderror" 
                id="nama" 
                name="nama" 
                value="{{ old('nama', $tenant->nama) }}" 
                required
            >
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
    <label for="lantaiTenant" class="form-label">Lantai</label>
    <input type="text" name="lantaiTenant" id="lantaiTenant" class="form-control" value="{{ old('lantaiTenant', $tenant->lantaiTenant) }}">
</div>

<div class="mb-3">
    <label for="ruanganTenant" class="form-label">Ruangan</label>
    <input type="text" name="ruanganTenant" id="ruanganTenant" class="form-control" value="{{ old('ruanganTenant', $tenant->ruanganTenant) }}">
</div>


        <button type="submit" class="btn btn-warning text-white">Simpan</button>
        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
