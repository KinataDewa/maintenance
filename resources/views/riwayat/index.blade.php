@extends('layouts.app')

@section('title', 'Menu Riwayat')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Aktivitas</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Riwayat Checklist Harian --}}
        <div class="col">
            <a href="{{ route('checklists.riwayat') }}" class="text-decoration-none">
                <div class="card border-success shadow-sm h-100 bg-white transition" style="transition: box-shadow 0.3s;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-list-check fs-4 me-2 text-success"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Checklist Harian</h6>
                        </div>
                        <small class="text-muted">Lihat semua riwayat checklist kerja harian staff maintenance.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Meteran Listrik --}}
        <div class="col">
            <a href="{{ route('meteran.riwayat') }}" class="text-decoration-none">
                <div class="card border-warning shadow-sm h-100 bg-white transition" style="transition: box-shadow 0.3s;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-lightning-charge fs-4 me-2 text-warning"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Meteran Listrik</h6>
                        </div>
                        <small class="text-muted">Lihat data penggunaan KWh dan dokumentasi meteran listrik.</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Pompa Air --}}
        <div class="col">
            {{-- <a href="{{ route('pompa-air.riwayat') }}" class="text-decoration-none"> --}}
                <div class="card border-primary shadow-sm h-100 bg-white transition" style="transition: box-shadow 0.3s;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-droplet-half fs-4 me-2 text-primary"></i>
                            <h6 class="mb-0 fw-semibold text-dark">Riwayat Pompa Air</h6>
                        </div>
                        <small class="text-muted">Lihat data riwayat pompa air bersih, diesel, dan hydrant.</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
