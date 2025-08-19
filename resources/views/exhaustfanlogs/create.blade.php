@extends('layouts.app')

@section('title', 'Input Log Exhaust Fan')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Log Exhaust Fan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('exhaustfanlogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exhaust_fan_id" class="form-label">Pilih Exhaust Fan</label>
            <select name="exhaust_fan_id" id="exhaust_fan_id" class="form-select" required>
                <option value="">-- Pilih Exhaust Fan --</option>
                @foreach ($exhaustFans as $fan)
                    <option value="{{ $fan->id }}" {{ old('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                        {{ $fan->nama }} - {{ $fan->ruangan }} - {{ $fan->merk }}
                    </option>
                @endforeach
            </select>
            @error('exhaust_fan_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="normal" {{ old('status') == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="tidak normal" {{ old('status') == 'tidak normal' ? 'selected' : '' }}>Tidak Normal</option>
            </select>
            @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
    <label class="form-label fw-semibold">Perawatan</label>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-1">
        @php
            $options = ['Pembersihan', 'Pemeriksaan', 'Penggantian Filter', 'Pelumasan', 'Lainnya'];
            $oldPerawatan = old('perawatan', []);
            if (!is_array($oldPerawatan)) {
                $oldPerawatan = explode(',', $oldPerawatan);
            }
        @endphp

        @foreach ($options as $option)
            <div class="col">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="perawatan[]"
                        id="perawatan_{{ \Illuminate\Support\Str::slug($option) }}"
                        value="{{ $option }}"
                        {{ in_array($option, $oldPerawatan) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perawatan_{{ \Illuminate\Support\Str::slug($option) }}">
                        {{ $option }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @error('perawatan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
</div>


        <div class="mb-3">
            <label for="foto_pembersihan" class="form-label">Foto Pembersihan (Opsional)</label>
            <input type="file" name="foto_pembersihan" id="foto_pembersihan" class="form-control" accept="image/*" capture="environment">
            @error('foto_pembersihan') <div class="text-danger small">{{ $message }}</div> @enderror

            <div class="mt-2">
                <img id="preview-image" src="#" alt="Preview Foto" class="img-fluid rounded" style="display: none; max-height: 300px;">
            </div>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
            @error('keterangan') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
    </form>
</div>

{{-- Preview Foto Script --}}
<script>
    document.getElementById('foto_pembersihan').addEventListener('change', function (event) {
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
