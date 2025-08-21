@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Dashboard Staff</h1>

    <div class="row g-4">
        {{-- Card Component --}}
        @php
            $cards = [
                [
                    'title' => 'Form Input Harian',
                    'icon' => 'journal-check',
                    'desc' => 'Akses semua form input harian di sini.',
                    'route' => route('dashboard.staff.formharian'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => '#0d6efd',
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'arrow-right-circle',
                ],
                [
                    'title' => 'Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Input laporan perawatan exhaust fan.',
                    'route' => route('exhaustfanlogs.create'),
                    'btn_text' => 'Input Exhaust Fan',
                    'btn_color' => '#6610f2', // ungu
                    'icon_color' => 'text-purple',
                    'btn_icon' => 'fan',
                ],
                [
                    'title' => 'Cleaning Panel',
                    'icon' => 'clipboard-check',
                    'desc' => 'Input laporan cleaning panel harian.',
                    'route' => route('panel-cleaning.create'),
                    'btn_text' => 'Input Cleaning Panel',
                    'btn_color' => '#198754', // hijau
                    'icon_color' => 'text-success',
                    'btn_icon' => 'clipboard-plus',
                ],
                [
                    'title' => 'Riwayat',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat seluruh catatan pekerjaan yang telah dilakukan.',
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
