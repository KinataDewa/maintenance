@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Daily Report</h1>

    <div class="row g-4">
        {{-- Card Component --}}
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
                    'icon_color' => '#fd7e14',
                    'desc' => 'Input data listrik induk dari PLN.',
                    'route' => route('induk.create'),
                    'btn_text' => 'Input Listrik Induk',
                    'btn_color' => '#fd7e14',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'plug-fill',
                ],
                [
                    'title' => 'Pompa',
                    'icon' => 'droplet-fill',
                    'desc' => 'Input data laporan setiap Pompa',
                    'route' => route('pompa.logs.create'),
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
                <div class="border rounded shadow-sm p-3 bg-white h-100 d-flex flex-column justify-content-between transition" style="transition: box-shadow 0.3s;">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-{{ $card['icon'] }} {{ $card['icon_color'] ?? '' }} me-2 fs-4"></i>
                            <h6 class="mb-0 fw-semibold text-dark">{{ $card['title'] }}</h6>
                        </div>
                        <small class="text-muted">{{ $card['desc'] }}</small>
                    </div>

                    <a href="{{ $card['route'] ?? '#' }}"
                        class="btn btn-sm mt-3 {{ $card['btn_outline'] ?? false ? 'btn-outline-secondary' : 'text-white' }}"
                        style="{{ $card['btn_outline'] ?? false ? '' : 'background-color: ' . ($card['btn_color'] ?? '#6c757d') }}">
                        <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                        {{ $card['btn_text'] ?? 'Lanjut' }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
