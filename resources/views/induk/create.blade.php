@extends('layouts.app')

@section('title', 'Input Meteran Induk PLN')

@section('content')
<div class="container">
    <h1 class="page-title">Input Meteran Induk PLN</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('meteran-induk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kwh" class="form-label">Kwh</label>
            <input type="number" step="0.01" name="kwh" id="kwh" class="form-control" required>
            @error('kwh') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="kvar" class="form-label">Kvar</label>
            <input type="number" step="0.01" name="kvar" id="kvar" class="form-control" required>
            @error('kvar') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="cos" class="form-label">Cos φ</label>
            <input type="number" step="0.01" name="cos" id="cos" class="form-control" required>
            @error('cos') <div class="text-danger small">{{ $message }}</div> @enderror
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