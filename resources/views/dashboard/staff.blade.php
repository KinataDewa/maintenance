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
                    'title' => 'Listrik',
                    'icon' => 'lightning-charge',
                    'desc' => 'Input Kwh tenant atau induk PLN.',
                    'is_listrik' => true,
                    'btn_color' => '#FFBD38',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'lightning-charge',
                ],
                [
                    'title' => 'Pompa Air',
                    'icon' => 'droplet-half',
                    'desc' => 'Isi laporan untuk pompa air bersih, diesel, dan hydrant.',
                    'is_pompa' => true,
                    'btn_color' => '#0d6efd',
                    'icon_color' => 'text-primary',
                ],
                [
                    'title' => 'Cek Suhu Ruangan',
                    'icon' => 'thermometer-half',
                    'desc' => 'Catat suhu & kelembapan setiap ruangan.',
                    'route' => route('suhu.index'),
                    'btn_text' => 'Cek Suhu',
                    'btn_color' => '#dc3545',
                    'icon_color' => 'text-danger',
                    'btn_icon' => 'thermometer-half',
                ],
                [
                    'title' => 'Checklist STP',
                    'icon' => 'water',
                    'desc' => 'Isi laporan harian STP.',
                    'route' => route('stp.index'),
                    'btn_text' => 'Isi STP',
                    'btn_color' => '#fd7e14',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'clipboard-check',
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
                            <i class="bi bi-{{ $card['icon'] }} {{ $card['icon_color'] ?? '' }} me-2 fs-4"></i>
                            <h6 class="mb-0 fw-semibold text-dark">{{ $card['title'] }}</h6>
                        </div>
                        <small class="text-muted">{{ $card['desc'] }}</small>
                    </div>

                   @if(isset($card['is_listrik']))
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('meteran.create') }}" class="btn btn-warning btn-sm w-50 text-white">
                                <i class="bi bi-plug"></i> Tenant
                            </a>
                            <a href="{{ route('induk.create') }}" class="btn btn-warning btn-sm w-50 text-white">
                                <i class="bi bi-building"></i> PLN
                            </a>
                        </div>
                    @elseif(isset($card['is_pompa']))
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('pompa.index') }}" class="btn btn-primary btn-sm w-50 text-white">
                                <i class="bi bi-list-ul"></i> Daftar
                            </a>
                            <a href="{{ route('pompa.logs.create') }}" class="btn btn-primary btn-sm w-50 text-white">
                                <i class="bi bi-list-ul"></i> Isi Log Pompa</a>
                        </div>

                    @else
                        <a href="{{ $card['route'] ?? '#' }}"
                        class="btn btn-sm mt-3 {{ $card['btn_outline'] ?? false ? 'btn-outline-secondary' : 'text-white' }}"
                        style="{{ $card['btn_outline'] ?? false ? '' : 'background-color: ' . ($card['btn_color'] ?? '#6c757d') }}">
                            <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                            {{ $card['btn_text'] ?? 'Lanjut' }}
                        </a>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
