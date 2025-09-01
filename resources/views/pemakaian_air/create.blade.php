@extends('layouts.app')

@section('title', 'Input Pemakaian Air')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Pemakaian Air</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pemakaian-air.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Sumber Air -->
        <div class="mb-3">
            <label for="sumber_air" class="form-label">Sumber Air</label>
            <select name="sumber_air" id="sumber_air" class="form-select" required>
                <option value="">-- Pilih Sumber Air --</option>
                <option value="PDAM" {{ old('sumber_air') == 'PDAM' ? 'selected' : '' }}>PDAM</option>
                <option value="STP" {{ old('sumber_air') == 'STP' ? 'selected' : '' }}>STP</option>
            </select>
            @error('sumber_air') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Meteran -->
        <div class="mb-3">
            <label for="meteran" class="form-label">Angka Meteran</label>
            <input type="number" step="0.01" name="meteran" id="meteran" 
                   class="form-control" value="{{ old('meteran') }}" required>
            @error('meteran') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" capture="environment">
            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror

            <div class="mt-2">
                <img id="preview-image" src="#" alt="Preview Foto" class="img-fluid rounded" style="display: none; max-height: 300px;">
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="2">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
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
