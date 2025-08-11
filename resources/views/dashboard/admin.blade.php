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
                    'title' => 'Checklist Harian',
                    'icon' => 'check2-square',
                    'desc' => 'Isi laporan kerja hari ini.',
                    'route' => route('checklist.index'),
                    'btn_text' => 'Mulai Checklist',
                    'btn_color' => '#198754', // hijau
                    'icon_color' => 'text-success',
                    'btn_icon' => 'play-fill',
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
                    'title' => 'Daftar Pompa Air',
                    'icon' => 'water',
                    'desc' => 'Lihat daftar pompa air dan kelola data.',
                    'route' => route('pompa.index'),
                    'btn_text' => 'Daftar Pompa Air',
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
