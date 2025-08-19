@extends('layouts.app')

@section('title', 'Input Meteran Listrik')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Meteran Listrik</h1>

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
            <label for="batasan" class="form-label">Batasan</label>
            <input type="number" step="0.01" name="batasan" class="form-control" required>
            @error('batasan') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Meteran</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" capture="environment" required>
            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror

            <div class="mt-2">
                <img id="preview-image" src="#" alt="Preview Foto" class="img-fluid rounded" style="display: none; max-height: 300px;">
            </div>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
            @error('deskripsi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
    </form>
</div>

{{-- Preview Foto Script --}}
<script>
    document.getElementById('foto').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-image');

        if (file && file.type.startsWith('image/')) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
@endsection
