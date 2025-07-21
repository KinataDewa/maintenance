@extends('layouts.app')

@section('title', 'Menu Riwayat')

@section('content')
<div class="container">
    <h1 class="mb-4">Riwayat Aktivitas</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Riwayat Checklist --}}
        <div class="col">
            <a href="{{ route('checklists.riwayat') }}" class="text-decoration-none text-dark">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-list-check me-2 text-warning"></i> Riwayat Checklist Harian
                        </h5>
                        <p class="card-text">Lihat semua riwayat checklist kerja harian staff maintenance.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Meteran Listrik --}}
        <div class="col">
            <a href="{{ route('meteran.riwayat') }}" class="text-decoration-none text-dark">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-lightning-charge me-2 text-primary"></i> Riwayat Meteran Listrik
                        </h5>
                        <p class="card-text">Lihat data penggunaan KWh dan dokumentasi meteran listrik.</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
