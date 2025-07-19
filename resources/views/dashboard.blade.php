@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-4 fw-bold text-dark">Dashboard Staff Maintenance</h1>

        <div class="row g-4">
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-clipboard-check-fill fs-4 text-warning me-2"></i>
                                <h5 class="card-title mb-0">Checklist Harian</h5>
                            </div>
                            <p class="card-text text-muted small">Isi laporan kerja untuk hari ini.</p>
                        </div>
                        <a href="{{ route('checklist.index') }}" class="btn btn-sm btn-warning w-100 mt-3">
                            <i class="bi bi-pencil-square me-1"></i> Mulai Checklist
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-clock-history fs-4 text-secondary me-2"></i>
                                <h5 class="card-title mb-0">Riwayat Checklist</h5>
                            </div>
                            <p class="card-text text-muted small">Lihat data checklist yang sudah dikirim.</p>
                        </div>
                        <a href="{{ route('riwayat.index') }}" class="btn btn-sm btn-outline-secondary w-100 mt-3">
                            <i class="bi bi-journal-text me-1"></i> Lihat Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
