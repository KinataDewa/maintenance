@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Dashboard Staff</h1>

    <div class="row g-4">
        @php
            $cards = [
                [
                    'title' => 'Form Harian',
                    'icon' => 'pencil-square',
                    'desc' => 'Akses semua form input harian di sini.',
                    'route' => route('dashboard.staff.formharian'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => 'primary', // biru
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'arrow-right-circle',
                ],
                [
                    'title' => 'Pengecekan',
                    'icon' => 'tools',
                    'desc' => 'Menu perawatan dan perbaikan rutin.',
                    'route' => route('dashboard.staff.perawatan'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => 'success',   // hijau bootstrap
                    'icon_color' => 'text-success',
                    'btn_icon' => 'gear',
                ],
                [
                    'title' => 'Riwayat',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat seluruh catatan pekerjaan yang telah dilakukan.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => 'secondary', // abu-abu
                    'btn_outline' => true,
                    'icon_color' => 'text-secondary',
                    'btn_icon' => 'journal-text',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card custom-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition border-top border-4 border-{{ $card['btn_color'] ?? 'secondary' }}">
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
                           class="btn w-100 mt-auto {{ $card['btn_outline'] ?? false ? 'btn-outline-' . ($card['btn_color'] ?? 'secondary') : 'btn-' . ($card['btn_color'] ?? 'secondary') }}">
                            <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                            {{ $card['btn_text'] ?? 'Lanjut' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Hover style --}}
<style>
    .card.transition:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
