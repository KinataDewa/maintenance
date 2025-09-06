@extends('layouts.app')

@section('title', 'Checklist Panel')

@section('content')
<div class="container py-4">
        <h1 class="page-title mb-4 fw-bold">Panel</h1>


    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body bg-light">
            <form action="{{ route('panel-inspections.store') }}" method="POST" class="needs-validation" novalidate>                @csrf

                {{-- Pilih Panel --}}
                <div class="mb-4">
                    <label for="panel_id" class="form-label fw-semibold">Pilih Panel <span class="text-danger">*</span></label>
                    <select class="form-select @error('panel_id') is-invalid @enderror" id="panel_id" name="panel_id" required>
                        <option value="">-- Pilih Panel --</option>
                        @foreach($panels as $panel)
                            <option value="{{ $panel->id }}">{{ $panel->nama }} - {{ $panel->lokasi }}</option>
                        @endforeach
                    </select>
                    @error('panel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Divider --}}
                <hr class="border-warning">

                {{-- Checklist --}}
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-list-check text-warning"></i> Checklist
                </h5>

                {{-- INSPEKSI VISUAL --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-eye-fill text-warning"></i> Inspeksi Visual
                        </h6>
                        <span class="badge text-dark">Step 1</span>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="kabel_terkupas" value="1" id="kabel_terkupas">
                        <label class="form-check-label" for="kabel_terkupas">Kabel terkupas / terbakar</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="mcb_rusak" value="1" id="mcb_rusak">
                        <label class="form-check-label" for="mcb_rusak">MCB rusak / gosong</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="panel_bersih" value="1" id="panel_bersih">
                        <label class="form-check-label" for="panel_bersih">Panel bersih dari debu</label>
                    </div>
                </div>

                {{-- PERIKSA SAMBUNGAN --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-plug-fill text-warning"></i> Periksa Sambungan
                        </h6>
                        <span class="badge bg-warning text-dark">Step 2</span>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="baut_terminal" value="1" id="baut_terminal">
                        <label class="form-check-label" for="baut_terminal">Baut terminal kencang</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="grounding_baik" value="1" id="grounding_baik">
                        <label class="form-check-label" for="grounding_baik">Grounding baik</label>
                    </div>
                </div>

                {{-- SUHU --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-thermometer-half text-warning"></i> Suhu
                        </h6>
                        <span class="badge bg-warning text-dark">Step 3</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="suhu_mcb" class="form-label">Suhu MCB Utama (°C)</label>
                            <input type="number" step="0.01" name="suhu_mcb" id="suhu_mcb" class="form-control" placeholder="Contoh: 35.5">
                        </div>
                        <div class="col-md-6">
                            <label for="suhu_terminal" class="form-label">Suhu Terminal (°C)</label>
                            <input type="number" step="0.01" name="suhu_terminal" id="suhu_terminal" class="form-control" placeholder="Contoh: 32.8">
                        </div>
                    </div>
                </div>

                {{-- FUNGSI PROTEKSI --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-shield-check text-warning"></i> Fungsi Proteksi
                        </h6>
                        <span class="badge bg-warning text-dark">Step 4</span>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="mcb_normal" value="1" id="mcb_normal">
                        <label class="form-check-label" for="mcb_normal">MCB berfungsi normal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="lampu_indikator" value="1" id="lampu_indikator">
                        <label class="form-check-label" for="lampu_indikator">Lampu indikator menyala</label>
                    </div>
                </div>

                {{-- KEBERSIHAN & KEAMANAN --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-lock-fill text-warning"></i> Kebersihan & Keamanan
                        </h6>
                        <span class="badge bg-warning text-dark">Step 5</span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="panel_tertutup" value="1" id="panel_tertutup">
                        <label class="form-check-label" for="panel_tertutup">Panel tertutup rapat</label>
                    </div>
                </div>

                {{-- CATATAN UMUM --}}
                <div class="mb-4 p-3 rounded border bg-white shadow-sm">
                    <label for="catatan" class="form-label fw-semibold">Catatan Umum</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan umum terkait pengecekan panel..."></textarea>
                </div>

                {{-- TOMBOL SIMPAN --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
