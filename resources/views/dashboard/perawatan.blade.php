@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Perawatan</h1>

    <div class="row g-4">
        @php
        $cards = [
                [
                    'title' => 'Perawatan Panel',
                    'icon' => 'hdd-network',
                    'desc' => 'Input laporan perawatan panel',
                    'route' => route('perawatan-panels.create'),
                    'btn_text' => 'Input Pengecekan Panel',
                    'btn_color' => '#fd7e14', 
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'hdd',
                ],    
                [
                    'title' => 'Perawatan Pompa',
                    'icon' => 'water',
                    'desc' => 'Input laporan perawatan pompa',
                    'route' => route('perawatan-pompa.create'),
                    'btn_text' => 'Input Pengecekan Pompa',
                    'btn_color' => '#0d6efd', 
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'droplet',
                ],
                [
                    'title' => 'Perawatan Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Input laporan perawatan exhaust fan',
                    'route' => route('perawatan-exhaust-fans.create'),
                    'btn_text' => 'Input Pengecekan Exhaust Fan',
                    'btn_color' => '#198754', 
                    'icon_color' => 'text-success',
                    'btn_icon' => 'wind',
                ],
                [
                    'title' => 'Perawatan AC',
                    'icon' => 'snow',
                    'desc' => 'Input laporan perawatan AC',
                    'route' => route('perawatan-ac.create'),
                    'btn_text' => 'Input Pengecekan AC',
                    'btn_color' => '#6f42c1', 
                    'icon_color' => 'text-info',
                    'btn_icon' => 'snow2',
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
