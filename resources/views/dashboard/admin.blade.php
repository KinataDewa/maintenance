@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Halo, {{ auth()->user()->name ?? 'Admin' }} 👋</h2>
        <p class="text-muted mb-0">Selamat datang di dashboard admin maintenance.</p>
    </div>

    {{-- Notifikasi Pengaduan Baru --}}
    @if($jumlahPengaduanBaru > 0)
        <div class="alert alert-warning d-flex justify-content-between align-items-center rounded-4 shadow-sm px-4 py-3 mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-bell-fill me-2 fs-5 text-dark"></i>
                <span>
                    <strong>{{ $jumlahPengaduanBaru }}</strong> pengaduan baru hari ini menunggu ditindaklanjuti.
                </span>
            </div>
            <a href="{{ route('pengaduan.riwayat') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                Lihat
            </a>
        </div>
    @endif

    {{-- Grid Card --}}
    <div class="row g-4">
        @php
            $cards = [
                [
                    'title' => 'Daftar Perangkat',
                    'icon' => 'cpu',
                    'desc' => 'Lihat dan kelola daftar perangkat.',
                    'route' => route('perangkat.index'),
                    'btn_text' => 'Lihat Perangkat',
                    'btn_color' => 'success',
                    'icon_color' => 'text-success',
                ],
                [
                    'title' => 'Daftar Tenant',
                    'icon' => 'building',
                    'desc' => 'Lihat dan kelola data tenant.',
                    'route' => route('tenants.index'),
                    'btn_text' => 'Lihat Tenant',
                    'btn_color' => 'primary',
                    'icon_color' => 'text-primary',
                ],
                [
                    'title' => 'Daftar Pompa',
                    'icon' => 'water',
                    'desc' => 'Lihat daftar pompa dan kelola data.',
                    'route' => route('pompa.index'),
                    'btn_text' => 'Lihat Pompa',
                    'btn_color' => 'info',
                    'icon_color' => 'text-info',
                ],
                [
                    'title' => 'Daftar Exhaust Fan',
                    'icon' => 'fan',
                    'desc' => 'Kelola daftar exhaust fan di gedung.',
                    'route' => route('exhaustfan.index'),
                    'btn_text' => 'Lihat Exhaust Fan',
                    'btn_color' => 'success',
                    'icon_color' => 'text-success',
                ],
                [
                    'title' => 'Daftar Panel',
                    'icon' => 'diagram-3',
                    'desc' => 'Lihat dan kelola daftar panel gedung.',
                    'route' => route('panel.index'),
                    'btn_text' => 'Lihat Panel',
                    'btn_color' => 'danger',
                    'icon_color' => 'text-danger',
                ],
                [
                    'title' => 'Daftar Staff',
                    'icon' => 'person-badge',
                    'desc' => 'Lihat dan kelola data staff.',
                    'route' => route('staff.index'),
                    'btn_text' => 'Lihat Staff',
                    'btn_color' => 'info',
                    'icon_color' => 'text-info',
                ],
                [
                    'title' => 'Daftar AC',
                    'icon' => 'snow',
                    'desc' => 'Kelola daftar AC (Indoor & Outdoor).',
                    'route' => route('acs.index'),
                    'btn_text' => 'Lihat AC',
                    'btn_color' => 'primary',
                    'icon_color' => 'text-primary',
                ],
                [
                    'title' => 'Riwayat Pekerjaan',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat semua catatan pekerjaan staff.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => 'secondary',
                    'icon_color' => 'text-secondary',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card custom-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column transition border-top border-4 border-{{ $card['btn_color'] }}">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 48px; height: 48px;">
                                    <i class="bi bi-{{ $card['icon'] }} fs-4 {{ $card['icon_color'] }}"></i>
                                </div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                            </div>
                            <small class="text-muted">{{ $card['desc'] }}</small>
                        </div>

                        <a href="{{ $card['route'] }}"
                           class="btn btn-{{ $card['btn_color'] }} w-100 mt-auto rounded-pill">
                            <i class="bi bi-arrow-right-circle me-1"></i> {{ $card['btn_text'] }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Hover Effect --}}
<style>
    .card.transition:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.15) !important;
        transform: scale(1.02);
        transition: all 0.25s ease-in-out;
    }
</style>
@endsection
