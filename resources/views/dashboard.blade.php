@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Dashboard</h1>

    <div class="row g-4">
        {{-- Card Component --}}
        @php
            $cards = [
                [
                    'title' => 'Checklist Harian',
                    'icon' => 'clipboard-check-fill',
                    'desc' => 'Isi laporan kerja hari ini.',
                    'route' => route('checklist.index'),
                    'btn_text' => 'Mulai Checklist',
                    'btn_color' => '#198754',
                    'icon_color' => 'text-success',
                    'btn_icon' => 'pencil-square',
                ],
                [
                    'title' => 'Meteran Listrik',
                    'icon' => 'lightning-charge',
                    'desc' => 'Input Kwh & upload foto tenant.',
                    'route' => route('meteran.create'),
                    'btn_text' => 'Input Sekarang',
                    'btn_color' => '#FFBD38',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'lightning-charge',
                ],
                [
                    'title' => 'Pompa Air',
                    'icon' => 'droplet-half',
                    'desc' => 'Isi laporan untuk pompa air bersih, diesel, dan hydrant.',
                    'route' => route('pompa-air.index'),
                    'btn_text' => 'Isi Form Pompa Air',
                    'btn_color' => '#0d6efd',
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'droplet',
                ],
                [
                    'title' => 'Pompa Air Bersih',
                    'icon' => 'droplet',
                    'desc' => 'Isi form pompa air bersih khusus.',
                    'route' => route('pompa-air.bersih'),
                    'btn_text' => 'Isi Form Bersih',
                    'btn_color' => '#6610f2',
                    'icon_color' => 'text-purple',
                    'btn_icon' => 'pencil-fill',
                ],
                [
                    'title' => 'Riwayat',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat data semua pekerjaan Anda.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => 'transparent',
                    'btn_outline' => true,
                    'icon_color' => 'text-secondary',
                    'btn_icon' => 'journal-text',
                ],
            ];
        @endphp


        @foreach ($cards as $card)
        <div class="col-md-6 col-xl-4">
            <div class="border rounded shadow-sm p-3 bg-white h-100 d-flex flex-column justify-content-between transition" style="transition: box-shadow 0.3s;">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-{{ $card['icon'] }} {{ $card['icon_color'] }} me-2 fs-4"></i>
                        <h6 class="mb-0 fw-semibold text-dark">{{ $card['title'] }}</h6>
                    </div>
                    <small class="text-muted">{{ $card['desc'] }}</small>
                </div>
                <a href="{{ $card['route'] }}" 
                   class="btn btn-sm mt-3 {{ $card['btn_outline'] ?? false ? 'btn-outline-secondary' : 'text-white' }}" 
                   style="{{ $card['btn_outline'] ?? false ? '' : 'background-color: ' . $card['btn_color'] }}">
                    <i class="bi bi-{{ $card['btn_icon'] }} me-1"></i> {{ $card['btn_text'] }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
