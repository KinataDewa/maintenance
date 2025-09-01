@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Daily Report</h1>

    <div class="row g-4">
        @php
            $cards = [
                [
                    'title' => 'Checklist On/Off Perangkat',
                    'icon' => 'clipboard-check-fill',
                    'desc' => 'Isi laporan kerja rutin setiap hari.',
                    'route' => route('checklist.index'),
                    'btn_text' => 'Mulai Checklist',
                    'btn_color' => '#198754',
                    'icon_color' => 'text-success',
                    'btn_icon' => 'pencil-square',
                ],
                [
                    'title' => 'Listrik Tenant',
                    'icon' => 'lightning-charge-fill',
                    'desc' => 'Catat pemakaian listrik setiap tenant.',
                    'route' => route('meteran.create'),
                    'btn_text' => 'Input Listrik Tenant',
                    'btn_color' => '#ffc107',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'lightning-charge-fill',
                ],
                [
                    'title' => 'Listrik Induk PLN',
                    'icon' => 'plug-fill',
                    'desc' => 'Input data listrik induk dari PLN.',
                    'route' => route('induk.create'),
                    'btn_text' => 'Input Listrik Induk',
                    'btn_color' => '#fd7e14',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'plug-fill',
                ],
                [
                    'title' => 'Pemakaian Air',
                    'icon' => 'droplet-fill',
                    'desc' => 'Input data laporan pemakaian air PDAM dan STP.',
                    'route' => route('pemakaian-air.create'),
                    'btn_text' => 'Isi Laporan Pompa',
                    'btn_color' => '#0d6efd',
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'droplet-fill',
                ],
                [
                    'title' => 'Suhu Ruangan',
                    'icon' => 'thermometer-half',
                    'desc' => 'Lihat dan catat suhu ruangan.',
                    'route' => route('temperature.create'),
                    'btn_text' => 'Catat Suhu',
                    'btn_color' => '#dc3545',
                    'icon_color' => 'text-danger',
                    'btn_icon' => 'thermometer-half',
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
