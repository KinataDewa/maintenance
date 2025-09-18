@extends('layouts.app')

@section('title', 'Input Perawatan Panel')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Input Perawatan Panel</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('perawatan-panels.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        <!-- Pilih Panel -->
        <div class="mb-3">
            <label for="panel_id" class="form-label">Pilih Panel</label>
            <select name="panel_id" id="panel_id" class="form-select @error('panel_id') is-invalid @enderror" required>
                <option value="">-- Pilih Panel --</option>
                @foreach($panels as $panel)
                    <option value="{{ $panel->id }}" {{ old('panel_id') == $panel->id ? 'selected' : '' }}>
                        {{ $panel->nama }} - {{ $panel->lokasi }}
                    </option>
                @endforeach
            </select>
            @error('panel_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-4">

        <!-- Pengecekan Panel -->
        <h5 class="fw-bold mb-3">Pengecekan Panel</h5>

        <!-- Pemeriksaan Visual -->
        <div class="mb-3">
            <label class="form-label">Pemeriksaan Visual</label>
            <div class="row">
                @php
                    $visualOptions = ['Karat', 'Noda Bekas Panas', 'Bau Hangus', 'Kabel Longgar', 'Isolasi Rusak'];
                @endphp
                @foreach($visualOptions as $item)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pengecekan[visual][]" value="{{ strtolower($item) }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pengujian & Pengukuran -->
        <div class="mb-3">
            <label class="form-label">Pengujian & Pengukuran</label>
            <div class="row">
                @php
                    $pengujianOptions = ['Tegangan', 'Arus', 'Suhu', 'Thermal Imaging'];
                @endphp
                @foreach($pengujianOptions as $item)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pengecekan[pengujian][]" value="{{ strtolower($item) }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pemeriksaan Lingkungan -->
        <div class="mb-3">
            <label class="form-label">Pemeriksaan Kondisi Lingkungan</label>
            <div class="row">
                @php
                    $lingkunganOptions = ['Lingkungan Aman', 'Tidak Ada Sumber Masalah'];
                @endphp
                @foreach($lingkunganOptions as $item)
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pengecekan[lingkungan][]" value="{{ strtolower($item) }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <hr class="my-4">

        <!-- Perawatan Panel -->
        <h5 class="fw-bold mb-3">Perawatan Panel</h5>

        <!-- Pembersihan -->
        <div class="mb-3">
            <label class="form-label">Pembersihan</label>
            @php
                $pembersihanOptions = ['Membersihkan Debu', 'Membersihkan Kotoran', 'Membersihkan Hama'];
            @endphp
            <div class="row">
                @foreach($pembersihanOptions as $item)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="perawatan[pembersihan][]" value="{{ $item }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pengencangan Koneksi -->
        <div class="mb-3">
            <label class="form-label">Pengencangan Koneksi</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="perawatan[pengencangan_koneksi][]" value="Mengencangkan sambungan yang longgar" id="pengencangan_sambungan">
                <label class="form-check-label" for="pengencangan_sambungan">Mengencangkan sambungan yang longgar</label>
            </div>
        </div>

        <!-- Penggantian Komponen -->
        <div class="mb-3">
            <label class="form-label">Penggantian Komponen</label>
            @php
                $penggantianOptions = ['Mengganti MCB', 'Mengganti Sekering', 'Mengganti Busbar'];
            @endphp
            <div class="row">
                @foreach($penggantianOptions as $item)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="perawatan[penggantian_komponen][]" value="{{ $item }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Perbaikan -->
        <div class="mb-3">
            <label class="form-label">Perbaikan</label>
            @php
                $perbaikanOptions = ['Perbaikan komponen rusak', 'Penggantian komponen rusak'];
            @endphp
            <div class="row">
                @foreach($perbaikanOptions as $item)
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="perawatan[perbaikan][]" value="{{ $item }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                        <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <hr class="my-4">

        <!-- Upload Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto Dokumentasi (Opsional)</label>
            <input type="file" name="foto[]" id="foto" class="form-control" multiple accept="image/*">
            <small class="text-muted">Boleh upload lebih dari satu foto</small>
            <div class="mt-2" id="preview-container"></div>
        </div>

        <!-- Catatan -->
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="2" placeholder="Tulis catatan tambahan jika diperlukan">{{ old('catatan') }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan Data
            </button>
        </div>
    </form>
</div>

{{-- Preview Foto Script --}}
<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const container = document.getElementById('preview-container');
        container.innerHTML = ''; // Bersihkan preview sebelumnya

        Array.from(event.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded mb-2 me-2';
                    img.style.maxHeight = '150px';
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
