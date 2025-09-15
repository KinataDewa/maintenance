@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Perawatan</h1>

    <div class="row g-4">
        @php
        $cards = [
                [
                    'title' => 'Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Input laporan perawatan exhaust fan.',
                    'route' => route('exhaustfanlogs.create'),
                    'btn_text' => 'Input Exhaust Fan',
                    'btn_color' => '#6610f2',
                    'icon_color' => 'text-purple',
                    'btn_icon' => 'fan',
                ],
                [
                    'title' => 'Cleaning Panel',
                    'icon' => 'clipboard-check',
                    'desc' => 'Input laporan cleaning panel harian.',
                    'route' => route('panel-cleaning.create'),
                    'btn_text' => 'Input Cleaning Panel',
                    'btn_color' => '#198754',
                    'icon_color' => 'text-success',
                    'btn_icon' => 'clipboard-plus',
                ],
                [
                    'title' => 'Perawatan Pompa',
                    'icon' => 'tools', // ganti jika ada icon pompa lain
                    'desc' => 'Input laporan perawatan pompa harian.',
                    'route' => route('pompa.maintenance.create'),
                    'btn_text' => 'Input Perawatan Pompa',
                    'btn_color' => '#0d6efd', // biru
                    'icon_color' => 'text-primary', // biru
                    'btn_icon' => 'droplet', // icon pompa/droplet
                ],
                [
                    'title' => 'Perawatan Panel',
                    'icon' => 'hdd-network', // icon panel listrik
                    'desc' => 'Input laporan pengecekan panel listrik.',
                    'route' => route('panel-inspections.create'), // route create untuk pengecekan panel
                    'btn_text' => 'Input Pengecekan Panel',
                    'btn_color' => '#fd7e14', // warna oranye untuk beda
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'hdd',
                ],
                [
                'title' => 'STP',
                'icon' => 'water', // icon yang relevan untuk STP
                'desc' => 'Input laporan pengecekan STP harian.',
                'route' => route('stp.index'), // route index STP
                'btn_text' => 'Input Pengecekan STP',
                'btn_color' => '#20c997', // hijau toska
                'icon_color' => 'text-info',
                'btn_icon' => 'water',
            ],    
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 shadow-m rounded-4 h-100 d-flex flex-column transition"
                     style="transition: transform 0.25s, box-shadow 0.25s;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 48px; height: 48px;">
                                    <i class="bi bi-{{ $card['icon'] }} fs-4 {{ $card['icon_color'] ?? '' }}"></i>
                                </div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                            </div>
                            <small class="text-muted">{{ $card['desc'] }}</small>
                        </div>

                        <a href="{{ $card['route'] ?? '#' }}"
                            class="btn w-100 mt-auto {{ $card['btn_outline'] ?? false ? 'btn-outline-secondary' : 'text-white' }}"
                            style="{{ $card['btn_outline'] ?? false ? '' : 'background-color: ' . ($card['btn_color'] ?? '#6c757d') }}">
                            <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                            {{ $card['btn_text'] ?? 'Lanjut' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Hover effect --}}
<style>
    .card.transition:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
