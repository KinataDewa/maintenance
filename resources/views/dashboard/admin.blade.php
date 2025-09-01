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
                    'btn_color' => 'success',
                    'btn_icon' => 'list-ul',
                    'count' => 15,
                ],
                [
                    'title' => 'Daftar Tenant',
                    'icon' => 'building',
                    'desc' => 'Lihat dan kelola data tenant.',
                    'route' => route('tenants.index'),
                    'btn_text' => 'Daftar Tenant',
                    'btn_color' => 'primary',
                    'btn_icon' => 'people-fill',
                    'count' => 12,
                ],
                [
                    'title' => 'Daftar Pompa',
                    'icon' => 'water',
                    'desc' => 'Lihat daftar pompa dan kelola data.',
                    'route' => route('pompa.index'),
                    'btn_text' => 'Daftar Pompa',
                    'btn_color' => 'info',
                    'btn_icon' => 'list-ul',
                    'count' => 6,
                ],
                [
                    'title' => 'Daftar Ruangan',
                    'icon' => 'door-closed',
                    'desc' => 'Pantau daftar ruangan, suhu & kelembapan.',
                    'route' => route('rooms.index'),
                    'btn_text' => 'Daftar Ruangan',
                    'btn_color' => 'warning',
                    'btn_icon' => 'list-ul',
                    'count' => 20,
                ],
                [
                    'title' => 'Daftar Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Kelola daftar exhaust fan di gedung.',
                    'route' => route('exhaustfan.index'),
                    'btn_text' => 'Daftar Exhaust Fan',
                    'btn_color' => 'success',
                    'btn_icon' => 'list-ul',
                    'count' => 10,
                ],
                [
                    'title' => 'Daftar Panel',
                    'icon' => 'diagram-3',
                    'desc' => 'Lihat dan kelola daftar panel gedung.',
                    'route' => route('panel.index'),
                    'btn_text' => 'Daftar Panel',
                    'btn_color' => 'danger',
                    'btn_icon' => 'list-ul',
                    'count' => 8,
                ],
                [
                    'title' => 'Daftar Staff',
                    'icon' => 'person-badge',
                    'desc' => 'Lihat dan kelola data staff.',
                    'route' => route('staff.index'),
                    'btn_text' => 'Daftar Staff',
                    'btn_color' => 'info',
                    'btn_icon' => 'list-ul',
                    'count' => 9,
                ],
                [
                    'title' => 'Riwayat Pekerjaan Staff',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat data semua pekerjaan Anda.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => 'secondary',
                    'btn_icon' => 'journal-text',
                    'count' => null,
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card custom-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition">
                    
                    <div class="card-top-line bg-{{ $card['btn_color'] }}"></div>
                    
                    <div class="card-body d-flex flex-column justify-content-between position-relative">
                                                

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-{{ $card['btn_color'] }} bg-opacity-10" 
                                     style="width: 50px; height: 50px;">
                                    <i class="bi bi-{{ $card['icon'] }} fs-3 text-{{ $card['btn_color'] }}"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h5>
                            </div>
                            <small class="text-muted d-block">{{ $card['desc'] }}</small>
                        </div>

                        <a href="{{ $card['route'] ?? '#' }}"
                            class="btn btn-outline-{{ $card['btn_color'] }} w-100 mt-auto">
                            <i class="bi bi-{{ $card['btn_icon'] ?? 'arrow-right' }} me-1"></i>
                            {{ $card['btn_text'] ?? 'Lanjut' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Style Hover + garis atas --}}
<style>
    .custom-card {
        position: relative;
        overflow: hidden;
    }
    .custom-card .card-top-line {
        height: 4px;
        width: 100%;
    }
    .custom-card.transition {
        transition: all 0.25s ease-in-out;
    }
    .custom-card.transition:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
