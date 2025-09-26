@extends('layouts.app')

@section('title', 'Input Perawatan Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Perawatan Exhaust Fan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('perawatan-exhaust-fans.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Exhaust Fan</label>
            <select name="exhaust_fan_id" class="form-select" required>
                <option value="">-- Pilih Exhaust Fan --</option>
                @foreach($exhaustFans as $fan)
                    <option value="{{ $fan->id }}" {{ old('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                        {{ $fan->nama_fan ?? $fan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <!-- Daya Hisap -->
            <div class="col-md-6 mb-3">
                <label for="daya_hisap" class="form-label fw-semibold">Daya Hisap (CFM)</label>
                <input type="number" step="0.01" name="daya_hisap" id="daya_hisap" class="form-control" placeholder="Contoh: 150.50">
            </div>

            <!-- Suhu -->
            <div class="col-md-6 mb-3">
                <label for="suhu" class="form-label fw-semibold">Suhu (°C)</label>
                <input type="number" step="0.01" name="suhu" id="suhu" class="form-control" placeholder="Contoh: 28.5">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="Before" {{ old('status')=='Before' ? 'selected' : '' }}>Before</option>
                <option value="After" {{ old('status')=='After' ? 'selected' : '' }}>After</option>
            </select>
        </div>

        <hr class="my-3">

        <h6 class="fw-bold">Pengecekan</h6>
        @foreach($pengecekanItems as $kategori => $checks)
            <div class="mb-2">
                <strong>{{ $kategori }}</strong>
                @foreach($checks as $check)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="pengecekan[{{ $kategori }}][]"
                               value="{{ $check }}"
                               id="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}"
                               {{ (old('pengecekan') && isset(old('pengecekan')[$kategori]) && in_array($check, old('pengecekan')[$kategori])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}">{{ $check }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <hr class="my-3">

        <h6 class="fw-bold">Perawatan</h6>
        @foreach($perawatanItems as $kategori => $checks)
            <div class="mb-2">
                <strong>{{ $kategori }}</strong>
                @foreach($checks as $check)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="perawatan[{{ $kategori }}][]"
                               value="{{ $check }}"
                               id="{{ \Illuminate\Support\Str::slug('perawatan-'.$kategori.'-'.$check) }}"
                               {{ (old('perawatan') && isset(old('perawatan')[$kategori]) && in_array($check, old('perawatan')[$kategori])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug('perawatan-'.$kategori.'-'.$check) }}">{{ $check }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="mb-3">
            <label class="form-label">Catatan (opsional)</label>
            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (opsional)</label>
            <input type="file" name="foto[]" multiple accept="image/*" class="form-control">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
