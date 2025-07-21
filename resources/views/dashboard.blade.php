@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-dark fs-4">Dashboard Staff Maintenance</h1>

    <div class="row g-3">
        {{-- Checklist Harian --}}
        <div class="col-md-6 col-xl-4">
            <div class="border rounded p-3 bg-white h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-clipboard-check-fill text-warning me-2 fs-4"></i>
                        <h6 class="mb-0 fw-semibold text-dark">Checklist Harian</h6>
                    </div>
                    <small class="text-muted">Isi laporan kerja hari ini.</small>
                </div>
                <a href="{{ route('checklist.index') }}" class="btn btn-sm mt-3 text-white" style="background-color: #FFBD38;">
                    <i class="bi bi-pencil-square me-1"></i> Mulai Checklist
                </a>
            </div>
        </div>

        {{-- Meteran Listrik --}}
        <div class="col-md-6 col-xl-4">
            <div class="border rounded p-3 bg-white h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-lightning-charge text-warning me-2 fs-4"></i>
                        <h6 class="mb-0 fw-semibold text-dark">Meteran Listrik</h6>
                    </div>
                    <small class="text-muted">Input Kwh & upload foto tenant.</small>
                </div>
                <a href="{{ route('meteran.create') }}" class="btn btn-sm mt-3 text-white" style="background-color: #FFBD38;">
                    <i class="bi bi-lightning-charge me-1"></i> Input Sekarang
                </a>
            </div>
        </div>
        
        {{-- Riwayat Checklist --}}
        <div class="col-md-6 col-xl-4">
            <div class="border rounded p-3 bg-white h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-clock-history text-secondary me-2 fs-4"></i>
                        <h6 class="mb-0 fw-semibold text-dark">Riwayat Checklist</h6>
                    </div>
                    <small class="text-muted">Lihat data checklist sebelumnya.</small>
                </div>
                <a href="{{ route('riwayat.index') }}" class="btn btn-sm mt-3 btn-outline-secondary">
                    <i class="bi bi-journal-text me-1"></i> Lihat Riwayat
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
