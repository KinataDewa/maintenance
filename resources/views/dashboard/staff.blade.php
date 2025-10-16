@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Halo, {{ auth()->user()->name ?? 'Staff' }} 👋</h2>
        <p class="text-muted mb-0">Selamat datang di dashboard staff maintenance.</p>
    </div>

    {{-- Notifikasi Pengaduan Baru (Opsi A) --}}
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


    <div class="row g-4">
        @php
            $cards = [
                [
                    'title' => 'Pengaduan Baru',
                    'icon' => 'exclamation-triangle-fill',
                    'desc' => $jumlahPengaduanBaru > 0
                        ? "Ada {$jumlahPengaduanBaru} pengaduan baru yang belum ditangani."
                        : "Tidak ada pengaduan baru saat ini.",
                    'route' => route('pengaduan.riwayat'),
                    'btn_text' => 'Lihat Pengaduan',
                    'btn_color' => $jumlahPengaduanBaru > 0 ? 'danger' : 'secondary',
                    'icon_color' => $jumlahPengaduanBaru > 0 ? 'text-danger' : 'text-secondary',
                    'btn_icon' => 'arrow-right-circle',
                ],
                [
                    'title' => 'Form Harian',
                    'icon' => 'pencil-square',
                    'desc' => 'Akses semua form input harian di sini.',
                    'route' => route('dashboard.staff.formharian'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => 'primary',
                    'icon_color' => 'text-primary',
                    'btn_icon' => 'arrow-right-circle',
                ],
                [
                    'title' => 'Pengecekan',
                    'icon' => 'tools',
                    'desc' => 'Menu pengecekan rutin dan inspeksi.',
                    'route' => route('dashboard.staff.pengecekan'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => 'warning', // kuning
                    'icon_color' => 'text-warning',
                    'btn_icon' => 'gear',
                ],
                [
                    'title' => 'Perawatan',
                    'icon' => 'wrench',
                    'desc' => 'Menu perawatan dan perbaikan rutin.',
                    'route' => route('dashboard.staff.perawatan'),
                    'btn_text' => 'Buka Menu',
                    'btn_color' => 'success', // hijau
                    'icon_color' => 'text-success',
                    'btn_icon' => 'gear',
                ],
                [
                    'title' => 'Perbaikan',
                    'icon' => 'hammer',
                    'desc' => 'Catat dan laporkan perbaikan untuk semua perangkat.',
                    'route' => route('perbaikan.create'),
                    'btn_text' => 'Input Perbaikan',
                    'btn_color' => 'danger', // merah
                    'icon_color' => 'text-danger',
                    'btn_icon' => 'tools',
                ],
                [
                    'title' => 'Riwayat',
                    'icon' => 'clock-history',
                    'desc' => 'Lihat seluruh catatan pekerjaan yang telah dilakukan.',
                    'route' => route('riwayat.index'),
                    'btn_text' => 'Lihat Riwayat',
                    'btn_color' => 'secondary',
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
