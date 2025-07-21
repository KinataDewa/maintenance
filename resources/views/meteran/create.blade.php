@extends('layouts.app')

@section('title', 'Input Meteran Listrik')

@section('content')
<div class="container">
    <h1 class="h4 mb-4">Input Meteran Listrik</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('meteran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="tenant_id" class="form-label">Tenant</label>
            <select name="tenant_id" id="tenant_id" class="form-select" required>
                <option value="">-- Pilih Tenant --</option>
                @foreach ($tenants as $tenant)
                    <option value="{{ $tenant->id }}">{{ $tenant->nama }}</option>
                @endforeach
            </select>
            @error('tenant_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="kwh" class="form-label">Angka Kwh</label>
            <input type="number" step="0.01" name="kwh" class="form-control" required>
            @error('kwh') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Meteran</label>
            <input type="file" name="foto" class="form-control"
            accept="image/*" capture="environment" required>
            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
            @error('deskripsi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
    </form>
</div>
@endsection
