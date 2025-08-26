@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Dashboard Staff</h1>

    <div class="row g-4">
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
                    'title' => 'Riwayat',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat seluruh catatan pekerjaan yang telah dilakukan.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => '#6c757d', // abu-abu
                    'btn_outline' => true,
                    'icon_color' => 'text-secondary',
                    'btn_icon' => 'journal-text',
                ],
                [
                    'title' => 'STP',
                    'icon' => 'water',
                    'desc' => 'Menu STP: input meteran dan pembersihan STP.',
                    'route' => route('stp.index'), // pastikan route sudah dibuat
                    'btn_text' => 'Buka Menu STP',
                    'btn_color' => '#0dcaf0',
                    'icon_color' => 'text-info',
                    'btn_icon' => 'droplet',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card custom-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition"
                     style="--card-border-color: {{ $card['btn_color'] ?? '#6c757d' }};">
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
                            style="{{ $card['btn_outline'] ?? false ? '' : 'background-color: ' . ($card['btn_color'] ?? '#6c757d') }};">
                            <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                            {{ $card['btn_text'] ?? 'Lanjut' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Hover & border style --}}
<style>
    .custom-card {
        border-top: 6px solid var(--card-border-color) !important;
    }

    .card.transition:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
        }
</style>
@endsection
