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


        {{-- Riwayat Meteran --}}
        <div class="col">
            <a href="{{ route('riwayat.meteran') }}" class="text-decoration-none text-dark">
                <div class="card border-info shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-lightning-charge me-2 text-info"></i> Riwayat Meteran Listrik
                        </h5>
                        <p class="card-text">Data log kWh dan foto bukti pengisian meteran listrik per tenant.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Riwayat Buku Tamu --}}
        
    </div>
</div>
@endsection
