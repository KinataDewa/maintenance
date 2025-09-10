@extends('layouts.app')

@section('title', 'Menu Riwayat')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Aktivitas</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Card Items --}}
        @php
            $cards = [
                [
                    'title' => 'Riwayat Checklist On/Off',
                    'icon' => 'list-check',
                    'color' => 'success',
                    'desc' => 'Lihat semua riwayat checklist kerja harian staff maintenance.',
                    'route' => route('checklist.riwayat'),
                ],
                [
                    'title' => 'Riwayat Listrik Tenant',
                    'icon' => 'lightning-charge',
                    'color' => 'warning',
                    'desc' => 'Lihat data penggunaan KWh dan dokumentasi meteran listrik.',
                    'route' => route('meteran.riwayat'),
                ],
                [
                    'title' => 'Riwayat Induk PLN',
                    'icon' => 'plug',
                    'color' => 'danger',
                    'desc' => 'Lihat data catatan kWh, kVar, dan cos φ dari meter induk PLN.',
                    'route' => route('meteran-induk.riwayat'),
                ],
                [
                    'title' => 'Riwayat Pemakaian Air',
                    'icon' => 'droplet-half',
                    'color' => 'primary',
                    'desc' => 'Lihat data riwayat pompa air bersih, diesel, dan hydrant.',
                    'route' => route('pemakaian-air.riwayat'),
                ],
                [
                    'title' => 'Riwayat Suhu Ruangan',
                    'icon' => 'thermometer-half',
                    'color' => 'danger',
                    'desc' => 'Lihat pencatatan suhu & dokumentasi setiap ruangan.',
                    'route' => route('room-temperature-logs.riwayat'),
                ],
                [
                    'title' => 'Riwayat Exhaust Fan',
                    'icon' => 'fan',
                    'color' => 'info',
                    'desc' => 'Lihat semua riwayat perawatan exhaust fan oleh staff.',
                    'route' => route('exhaustfanlogs.riwayat'),
                ],
                [
                    'title' => 'Riwayat Cleaning Panel',
                    'icon' => 'clipboard-check',
                    'color' => 'success',
                    'desc' => 'Lihat riwayat laporan cleaning panel beserta dokumentasi foto before/after.',
                    'route' => route('panel-cleaning.riwayat'),
                ],
                [
                    'title' => 'Riwayat Perawatan Pompa',
                    'icon' => 'tools', // icon mewakili pompa mekanik
                    'color' => 'primary', // biru
                    'desc' => 'Lihat semua catatan perawatan pompa harian oleh staff.',
                    'route' => route('pompa.maintenance.riwayat'),
                ],
                [
                    'title' => 'Riwayat Pengecekan Panel',
                    'icon' => 'hdd-network',
                    'color' => 'warning',
                    'desc' => 'Lihat riwayat pengecekan panel listrik dan hasil inspeksi.',
                    'route' => route('panel-inspections.riwayat'),
                ],
                [
                    'title' => 'Riwayat Pompa STP',
                    'icon' => 'gear-wide-connected',
                    'color' => 'success',
                    'desc' => 'Lihat riwayat pengecekan kondisi pompa STP 1 dan STP 2.',
                    'route' => route('pompa-stp.riwayat'),
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col">
                <a href="{{ $card['route'] }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                     style="width: 50px; height: 50px;">
                                    <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                </div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                            </div>
                            <small class="text-muted">{{ $card['desc'] }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

{{-- Custom Style --}}
<style>
    .riwayat-card {
        transition: all 0.25s ease-in-out;
    }
    .riwayat-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
