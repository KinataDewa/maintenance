@extends('layouts.app')

@section('title', 'Input Pengecekan Pompa')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Pengecekan Pompa</h3>

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

    <form action="{{ route('pengecekan-pompas.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        {{-- Pilih Pompa --}}
        <div class="mb-3">
            <label for="pompa_unit_id" class="form-label fw-semibold">Pilih Pompa</label>
            <select name="pompa_unit_id" id="pompa_unit_id" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                @foreach($pompas as $pompa)
                    <option value="{{ $pompa->id }}" {{ old('pompa_unit_id') == $pompa->id ? 'selected' : '' }}>
                        {{ $pompa->nama_pompa }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Suhu --}}
        <div class="mb-3">
            <label for="suhu" class="form-label fw-semibold">Suhu (°C)</label>
            <input type="number" step="0.01" name="suhu" id="suhu" class="form-control" value="{{ old('suhu') }}" placeholder="Masukkan suhu">
        </div>

        {{-- Tekanan --}}
        <div class="mb-3">
            <label for="tekanan" class="form-label fw-semibold">Tekanan (Bar)</label>
            <input type="number" step="0.01" name="tekanan" id="tekanan" class="form-control" value="{{ old('tekanan') }}" placeholder="Masukkan tekanan">
        </div>

        {{-- Checklist Pengecekan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Checklist Pengecekan</label>
            @php
                $items = [
                    'Pemeriksaan visual' => [
                        'Mengamati kondisi fisik',
                        'Mencari kebocoran',
                        'Tanda korosi',
                        'Kerusakan pada eksterior motor'
                    ],
                    'Pemeriksaan suara dan getaran' => [
                        'Mendengarkan bunyi tidak wajar',
                        'Merasakan adanya getaran berlebihan'
                    ],
                    'Memeriksa suara' => [
                        'Halus',
                        'Kasar'
                    ],
                    'Melihat tingkat oli' => [
                        'Memeriksa indikator oli pada bantalan untuk melihat adanya air atau perubahan warna'
                    ]
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

        {{-- Foto --}}
        <div class="mb-3">
            <label for="foto" class="form-label fw-semibold">Foto (Opsional)</label>
            <input type="file" name="foto[]" id="foto" class="form-control" multiple accept="image/*">
            <div class="mt-2" id="previewContainer"></div>
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label for="catatan" class="form-label fw-semibold">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" rows="3" class="form-control">{{ old('catatan') }}</textarea>
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
