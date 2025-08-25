@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Dashboard Admin</h1>

    <div class="row g-4">
        @php
            $cards = [
                [
                    'title' => 'Daftar Perangkat',
                    'icon' => 'cpu',
                    'desc' => 'Lihat dan kelola daftar perangkat.',
                    'route' => route('perangkat.index'),
                    'btn_text' => 'Daftar Perangkat',
                    'btn_color' => '#198754',
                    'icon_color' => 'text-success',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Tenant',
                    'icon' => 'building',
                    'desc' => 'Lihat dan kelola data tenant.',
                    'route' => route('tenants.index'),
                    'btn_text' => 'Daftar Tenant',
                    'btn_color' => '#6f42c1',
                    'icon_color' => 'text-purple',
                    'btn_icon' => 'people-fill',
                ],
                [
                    'title' => 'Daftar Pompa',
                    'icon' => 'water',
                    'desc' => 'Lihat daftar pompa dan kelola data.',
                    'route' => route('pompa.index'),
                    'btn_text' => 'Daftar Pompa',
                    'btn_color' => '#0d6efd',
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Ruangan',
                    'icon' => 'door-closed',
                    'desc' => 'Pantau daftar ruangan, suhu & kelembapan.',
                    'route' => route('rooms.index'),
                    'btn_text' => 'Daftar Ruangan',
                    'btn_color' => '#fd7e14',
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Kelola daftar exhaust fan di gedung.',
                    'route' => route('exhaustfan.index'),
                    'btn_text' => 'Daftar Exhaust Fan',
                    'btn_color' => '#20c997',
                    'icon_color' => 'text-success',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Panel',
                    'icon' => 'diagram-3',
                    'desc' => 'Lihat dan kelola daftar panel gedung.',
                    'route' => route('panel.index'),
                    'btn_text' => 'Daftar Panel',
                    'btn_color' => '#dc3545',
                    'icon_color' => 'text-danger',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Staff',
                    'icon' => 'person-badge',
                    'desc' => 'Lihat dan kelola data staff.',
                    'route' => route('staff.index'),
                    'btn_text' => 'Daftar Staff',
                    'btn_color' => '#0dcaf0',
                    'icon_color' => 'text-info',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Riwayat Pekerjaan Staff',
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
                <div class="card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition"
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
        /* transform: translateY(-5px); */
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
