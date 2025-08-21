@extends('layouts.app')

@section('title', 'Menu Riwayat')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Aktivitas</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Riwayat Checklist Harian --}}
        <div class="col">
            <a href="{{ route('checklist.riwayat') }}" class="text-decoration-none">
                <div class="card border-success shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-list-check fs-4 me-2 text-success"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Checklist On/Off</h6>
                        </div>
                        <small class="text-muted">Lihat semua riwayat checklist kerja harian staff maintenance.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Meteran Listrik --}}
        <div class="col">
            <a href="{{ route('meteran.riwayat') }}" class="text-decoration-none">
                <div class="card border-warning shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-lightning-charge fs-4 me-2 text-warning"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Listrik Tenant</h6>
                        </div>
                        <small class="text-muted">Lihat data penggunaan KWh dan dokumentasi meteran listrik.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Induk PLN --}}
        <div class="col">
            <a href="{{ route('meteran-induk.riwayat') }}" class="text-decoration-none">
                <div class="card border-danger shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-plug fs-4 me-2 text-danger"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Induk PLN</h6>
                        </div>
                        <small class="text-muted">Lihat data catatan kWh, kVar, dan cos φ dari meter induk PLN.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Pompa --}}
        <div class="col">
            <a href="{{ route('pompa.logs.riwayat') }}" class="text-decoration-none">
                <div class="card border-primary shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-droplet-half fs-4 me-2 text-primary"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Pompa</h6>
                        </div>
                        <small class="text-muted">Lihat data riwayat pompa air bersih, diesel, dan hydrant.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- ✅ Riwayat Suhu Ruangan --}}
        <div class="col">
            <a href="{{ route('room-temperature-logs.riwayat') }}" class="text-decoration-none">
                <div class="card border-danger shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-thermometer-half fs-4 me-2 text-danger"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Suhu Ruangan</h6>
                        </div>
                        <small class="text-muted">Lihat pencatatan suhu & dokumentasi setiap ruangan.</small>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- Riwayat Exhaust Fan --}}
        <div class="col">
            <a href="{{ route('exhaustfanlogs.riwayat') }}" class="text-decoration-none">
                <div class="card border-info shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-fan fs-4 me-2 text-info"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Exhaust Fan</h6>
                        </div>
                        <small class="text-muted">Lihat semua riwayat perawatan exhaust fan oleh staff.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Cleaning Panel --}}
        <div class="col">
            <a href="{{ route('panel-cleaning.riwayat') }}" class="text-decoration-none">
                <div class="card border-success shadow-sm h-100 bg-white transition">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-clipboard-check fs-4 me-2 text-success"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Cleaning Panel</h6>
                        </div>
                        <small class="text-muted">Lihat riwayat laporan cleaning panel harian beserta dokumentasi foto before/after.</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
