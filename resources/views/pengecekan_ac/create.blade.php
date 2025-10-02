@extends('layouts.app')

@section('title', 'Input Pengecekan AC')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Input Pengecekan AC</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('pengecekan-ac.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        <!-- Pilih AC -->
        <div class="mb-3">
            <label for="ac_id" class="form-label fw-semibold">Pilih AC</label>
            <select name="ac_id" id="ac_id" class="form-select @error('ac_id') is-invalid @enderror" required>
                <option value="">-- Pilih AC --</option>
                @foreach($acs as $ac)
                    <option value="{{ $ac->id }}" {{ old('ac_id') == $ac->id ? 'selected' : '' }}>
                        {{ $ac->nama }} - {{ $ac->ruangan }} ({{ $ac->merk }})
                    </option>
                @endforeach
            </select>
            @error('ac_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lokasi -->
        <div class="mb-3">
            <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
            <select id="lokasi" name="lokasi" class="form-select" required>
                <option value="">-- Pilih Lokasi --</option>
                <option value="Indoor">Indoor</option>
                <option value="Outdoor">Outdoor</option>
            </select>
        </div>

        <!-- Checklist Indoor -->
        <div id="checklist-indoor" style="display:none;">
            <h5 class="fw-bold mb-3">Checklist Indoor</h5>
            
            <div class="mb-3">
                <label class="form-label">Pengecekan Indoor</label>
                <div class="row">
                    @php
                        $indoorChecks = [
                            'Filter Udara',
                            'Suhu Ruangan',
                            'Hembusan Blower',
                            'Indikator Panel & Remote',
                            'Saluran Pembuangan Air',
                            'Kebocoran Air Indoor',
                            'Kondisi Kabel Listrik'
                        ];
                    @endphp
                    @foreach($indoorChecks as $item)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pengecekan[]" value="{{ $item }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                                <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Checklist Outdoor -->
        <div id="checklist-outdoor" style="display:none;">
            <h5 class="fw-bold mb-3">Checklist Outdoor</h5>
            
            <div class="mb-3">
                <label class="form-label">Pengecekan Outdoor</label>
                <div class="row">
                    @php
                        $outdoorChecks = [
                            'Suara & Getaran Kompresor',
                            'Tekanan Freon',
                            'Kondisi Sirip Kondensor',
                            'Putaran Kipas Outdoor',
                            'Isolasi Pipa',
                            'Terminal Kabel & Kapasitor'
                        ];
                    @endphp
                    @foreach($outdoorChecks as $item)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pengecekan[]" value="{{ $item }}" id="{{ strtolower(str_replace(' ', '_', $item)) }}">
                                <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $item)) }}">{{ $item }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <hr class="my-4">

        <!-- Upload Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label fw-semibold">Upload Foto Dokumentasi (Opsional)</label>
            <input type="file" name="foto[]" id="foto" class="form-control" multiple accept="image/*">
            <small class="text-muted">Boleh upload lebih dari satu foto</small>
            <div class="mt-2" id="preview-container"></div>
        </div>

        <!-- Catatan -->
        <div class="mb-3">
            <label for="catatan" class="form-label fw-semibold">Catatan (Opsional)</label>
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

{{-- Script Checklist Lokasi --}}
<script>
    function updateChecklistDisplay() {
        let lokasi = document.getElementById('lokasi').value;
        
        let indoor = document.getElementById('checklist-indoor');
        let outdoor = document.getElementById('checklist-outdoor');

        // tampilkan checklist sesuai lokasi
        indoor.style.display = (lokasi === 'Indoor') ? 'block' : 'none';
        outdoor.style.display = (lokasi === 'Outdoor') ? 'block' : 'none';
    }

    // trigger saat ganti lokasi/status
    document.getElementById('lokasi').addEventListener('change', updateChecklistDisplay);
    // jalankan saat pertama kali load (default Before)
    document.addEventListener('DOMContentLoaded', updateChecklistDisplay);

    // Preview foto
    document.getElementById('foto').addEventListener('change', function(event) {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';
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
