@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Dashboard Admin</h1>

    <div class="row g-4">
        {{-- Card Component --}}
        @php
            $cards = [
                [
                    'title' => 'Daftar Perangkat',
                    'icon' => 'cpu',
                    'desc' => 'Lihat dan kelola daftar perangkat.',
                    'route' => route('perangkat.index'),
                    'btn_text' => 'Daftar Perangkat',
                    'btn_color' => '#198754', // teal
                    'icon_color' => 'text-success',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Tenant',
                    'icon' => 'building',
                    'desc' => 'Lihat dan kelola data tenant.',
                    'route' => route('tenants.index'),
                    'btn_text' => 'Daftar Tenant',
                    'btn_color' => '#6f42c1', // ungu
                    'icon_color' => 'text-purple',
                    'btn_icon' => 'people-fill',
                ],
                [
                    'title' => 'Daftar Pompa',
                    'icon' => 'water',
                    'desc' => 'Lihat daftar pompa dan kelola data.',
                    'route' => route('pompa.index'),
                    'btn_text' => 'Daftar Pompa',
                    'btn_color' => '#0d6efd', // biru
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Ruangan',
                    'icon' => 'door-closed',
                    'desc' => 'Lihat daftar ruangan untuk pantau suhu & kelembapan.',
                    'route' => route('rooms.index'),
                    'btn_text' => 'Daftar Ruangan',
                    'btn_color' => '#fd7e14', // oranye
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'list-ul',
                ],
                // Tambahan menu Exhaust Fan
                [
                    'title' => 'Daftar Exhaust Fan',
                    'icon' => 'fan', // icon Bootstrap icons (gunakan icon yang mendekati jika tidak ada fan)
                    'desc' => 'Kelola daftar exhaust fan di gedung.',
                    'route' => route('exhaustfan.index'),
                    'btn_text' => 'Daftar Exhaust Fan',
                    'btn_color' => '#20c997', // hijau muda
                    'icon_color' => 'text-success',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Panel',
                    'icon' => 'diagram-3', // icon Bootstrap Icons yang mendekati
                    'desc' => 'Lihat dan kelola daftar panel gedung.',
                    'route' => route('panel.index'),
                    'btn_text' => 'Daftar Panel',
                    'btn_color' => '#fd3e3e', // merah terang
                    'icon_color' => 'text-danger',
                    'btn_icon' => 'list-ul',
                ],
                [
                    'title' => 'Daftar Staff',
                    'icon' => 'person-badge',
                    'desc' => 'Lihat dan kelola data staff.',
                    'route' => route('staff.index'),
                    'btn_text' => 'Daftar Staff',
                    'btn_color' => '#0dcaf0', // cyan
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
