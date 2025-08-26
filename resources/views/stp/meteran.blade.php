@extends('layouts.app')

@section('title', 'Input Meteran STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Meteran Pompa STP</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('stp.meteran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Angka Meteran -->
        <div class="mb-3">
            <label for="meteran" class="form-label">Angka Meteran (kWh)</label>
            <input type="number" step="0.01" name="meteran" id="meteran" class="form-control" required>
            @error('meteran') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Foto Meteran -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Meteran</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" capture="environment" required>
            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror

            <div class="mt-2">
                <img id="preview-image" src="#" alt="Preview Foto" class="img-fluid rounded shadow-sm" style="display: none; max-height: 300px;">
            </div>
        </div>

        <!-- Keterangan Opsional -->
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="2"></textarea>
            @error('keterangan') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        
        <!-- Tombol Simpan -->
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-warning btn-lg text-white shadow-sm">
                <i class="bi bi-save me-2"></i> Simpan
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
