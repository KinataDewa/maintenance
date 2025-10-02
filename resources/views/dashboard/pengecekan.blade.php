@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Pengecekan</h1>

    <div class="row g-4">
        @php
        $cards = [
            [
                'title' => 'STP',
                'icon' => 'water',
                'desc' => 'Input laporan pengecekan STP harian.',
                'route' => route('stp.index'),
                'btn_text' => 'Input Pengecekan STP',
                'btn_color' => '#20c997', // hijau toska
                'icon_color' => 'text-success',
                'btn_icon' => 'water',
            ],
            [
                'title' => 'Pengecekan Panel',
                'icon' => 'cpu', // icon panel listrik
                'desc' => 'Input laporan pengecekan panel listrik harian.',
                'route' => route('pengecekan-panels.create'),
                'btn_text' => 'Input Pengecekan Panel',
                'btn_color' => '#fd7e14', // oranye
                'icon_color' => 'text-warning',
                'btn_icon' => 'cpu',
            ],
            [
                'title' => 'Pengecekan Pompa',
                'icon' => 'water',
                'desc' => 'Input laporan pengecekan pompa',
                'route' => route('pengecekan-pompas.create'),
                'btn_text' => 'Input Pengecekan Pompa',
                'btn_color' => '#0d6efd', 
                'icon_color' => 'text-primary',
                'btn_icon' => 'droplet',
            ],   
            [
                'title' => 'Pengecekan Exhaust Fan',
                'icon' => 'fan',
                'desc' => 'Input laporan pengecekan exhaust fan',
                'route' => route('pengecekan-exhaust-fans.create'),
                'btn_text' => 'Input Pengecekan Exhaust Fan',
                'btn_color' => '#198754', // hijau
                'icon_color' => 'text-success',
                'btn_icon' => 'wind',
            ],
            [
                'title' => 'Pengecekan AC',
                'icon' => 'snow',
                'desc' => 'Input laporan Pengecekan AC',
                'route' => route('pengecekan-ac.create'),
                'btn_text' => 'Input Pengecekan AC',
                'btn_color' => '#6f42c1', 
                'icon_color' => 'text-info',
                'btn_icon' => 'snow2',
            ],          
        ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition"
                     style="transition: transform 0.25s, box-shadow 0.25s;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 48px; height: 48px;">
                                    <i class="bi bi-{{ $card['icon'] }} fs-4 {{ $card['icon_color'] }}"></i>
                                </div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                            </div>
                            <small class="text-muted">{{ $card['desc'] }}</small>
                        </div>

                        <a href="{{ $card['route'] ?? '#' }}"
                            class="btn w-100 mt-auto text-white"
                            style="background-color: {{ $card['btn_color'] }};">
                            <i class="bi bi-{{ $card['btn_icon'] }} me-1"></i>
                            {{ $card['btn_text'] }}
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
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
