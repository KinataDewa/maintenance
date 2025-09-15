@extends('layouts.app')

@section('content')

<div class="container my-4" style="font-family: 'Poppins', sans-serif;">
    <h1 class="page-title mb-2 fw-bold text-dark">Menu STP</h1>
    <p class="text-muted mb-4">Silakan pilih menu untuk mengakses fitur STP.</p>

    <div class="row g-3">

        <!-- Perawatan STP -->
        <div class="col-12 col-md-3">
            <a href="{{ route('stp.perawatan') }}" class="text-decoration-none">
                <div class="card menu-card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-tools icon-success"></i>
                        <h6 class="fw-bold mt-2 mb-1">Perawatan STP</h6>
                        <p class="text-muted small">Laporan pembersihan & perawatan.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Input Pompa STP -->
        <div class="col-12 col-md-3">
            <a href="{{ route('pompa-stp.create') }}" class="text-decoration-none">
                <div class="card menu-card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-water icon-info"></i>
                        <h6 class="fw-bold mt-2 mb-1">Input Pompa STP</h6>
                        <p class="text-muted small">Isi data pengecekan Pompa STP harian.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Input Mesin STP -->
        <div class="col-12 col-md-3">
            <a href="{{ route('mesin-stp.create') }}" class="text-decoration-none">
                <div class="card menu-card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-cpu icon-warning"></i>
                        <h6 class="fw-bold mt-2 mb-1">Input Mesin STP</h6>
                        <p class="text-muted small">Isi data pengecekan Mesin STP harian.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
.page-title {
    font-size: 1.5rem;
}
.menu-card {
    border: none;
    border-radius: 12px;
    padding: 1.2rem 0.8rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.25s ease-in-out;
}
.menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}
.menu-card i {
    font-size: 2rem;
    margin-bottom: .3rem;
}
.icon-primary { color: #0dcaf0; }
.icon-warning { color: #ffc107; }
.icon-success { color: #198754; }
.icon-info { color: #0d6efd; } /* Warna biru untuk Pompa STP */
</style>
@endsection
