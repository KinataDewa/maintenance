@extends('layouts.app')

@section('title', 'Input Pengecekan Panel')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Pengecekan Panel</h3>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert error --}}
    @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <div class="fw-bold mb-1">Terjadi kesalahan:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengecekan-panels.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        {{-- Pilih Panel --}}
        <div class="mb-3">
            <label for="panel_id" class="form-label fw-semibold">Pilih Panel</label>
            <select name="panel_id" id="panel_id" class="form-select" required>
                <option value="">-- Pilih Panel --</option>
                @foreach($panels as $panel)
                    <option value="{{ $panel->id }}" {{ old('panel_id') == $panel->id ? 'selected' : '' }}>
                        {{ $panel->nama }} - {{ $panel->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Checklist Pengecekan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Checklist Pengecekan</label>
            @php
                $items = [
                    'Pemeriksaan Visual' => ['Karat', 'Noda Bekas Panas', 'Bau Hangus', 'Kabel Longgar', 'Isolasi Rusak'],
                    'Pemeriksaan Kondisi Lingkungan' => ['Lingkungan Aman', 'Tidak Ada Sumber Masalah'],
                ];
                $oldChecks = old('pengecekan', []);
            @endphp

            @foreach($items as $kategori => $checks)
                <div class="mb-2">
                    <strong>{{ $kategori }}</strong>
                    @foreach($checks as $check)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pengecekan[{{ $kategori }}][]" id="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}" value="{{ $check }}"
                                {{ isset($oldChecks[$kategori]) && in_array($check, $oldChecks[$kategori]) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}">{{ $check }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Pengujian & Pengukuran --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pengujian & Pengukuran</label>

            <div class="row g-3">
                <div class="col-md-3">
                    <label for="tegangan" class="form-label">Tegangan (V)</label>
                    <input type="number" step="any" name="tegangan" id="tegangan" value="{{ old('tegangan') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="arus" class="form-label">Arus (A)</label>
                    <input type="number" step="any" name="arus" id="arus" value="{{ old('arus') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="suhu" class="form-label">Suhu (°C)</label>
                    <input type="number" step="any" name="suhu" id="suhu" value="{{ old('suhu') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="thermal_imaging" class="form-label">Thermal Imaging (°C)</label>
                    <input type="number" step="any" name="thermal_imaging" id="thermal_imaging" value="{{ old('thermal_imaging') }}" class="form-control">
                </div>
            </div>
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label for="catatan" class="form-label fw-semibold">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" rows="3" class="form-control">{{ old('catatan') }}</textarea>
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label for="foto" class="form-label fw-semibold">Foto (Opsional)</label>
            <input type="file" name="foto[]" id="foto" class="form-control" multiple accept="image/*">
            <div class="mt-2" id="previewContainer"></div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Preview multiple images
document.getElementById('foto')?.addEventListener('change', function() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    const files = this.files;
    if(!files) return;
    Array.from(files).forEach(file => {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.classList.add('img-fluid', 'rounded', 'me-2', 'mb-2');
        img.style.maxHeight = '120px';
        container.appendChild(img);
    });
});
</script>
@endpush
@endsection
