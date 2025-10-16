@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Halo, {{ auth()->user()->name ?? 'Admin' }} 👋</h2>
        <p class="text-muted mb-0">Selamat datang di dashboard admin maintenance.</p>
    </div>

    {{-- 🔔 Notifikasi Pengaduan Baru --}}
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

    {{-- ⚡ Grafik Pemakaian Listrik --}}
    <div class="card shadow-sm mb-4 border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient fw-bold text-dark d-flex justify-content-between align-items-center"
             style="background: linear-gradient(90deg, #ffbd38, #ffc857);">
            <div class="text-dark">
                <i class="bi bi-lightning-charge-fill me-2"></i> Grafik Pemakaian Listrik
            </div>
            <form method="GET" action="{{ route('dashboard') }}" class="d-flex align-items-center">
                <select name="tenant_id" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    <option value="">Semua Tenant</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ $tenantId == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->nama }}
                        </option>
                    @endforeach
                </select>
                <noscript><button class="btn btn-sm btn-dark">Filter</button></noscript>
            </form>
        </div>
        <div class="card-body p-4">
            @if(count($values) > 0)
                <canvas id="meteranChart" height="120"></canvas>
            @else
                <div class="text-center text-muted py-4">Belum ada data meteran listrik untuk tenant ini.</div>
            @endif
        </div>
    </div>

    {{-- 🔹 Grid Card Menu --}}
    <div class="row g-4">
        @php
            $cards = [
                ['title' => 'Daftar Perangkat', 'icon' => 'cpu', 'desc' => 'Lihat dan kelola daftar perangkat.', 'route' => route('perangkat.index'), 'btn_text' => 'Lihat Perangkat', 'btn_color' => 'success', 'icon_color' => 'text-success'],
                ['title' => 'Daftar Tenant', 'icon' => 'building', 'desc' => 'Lihat dan kelola data tenant.', 'route' => route('tenants.index'), 'btn_text' => 'Lihat Tenant', 'btn_color' => 'primary', 'icon_color' => 'text-primary'],
                ['title' => 'Daftar Pompa', 'icon' => 'water', 'desc' => 'Lihat daftar pompa dan kelola data.', 'route' => route('pompa.index'), 'btn_text' => 'Lihat Pompa', 'btn_color' => 'info', 'icon_color' => 'text-info'],
                ['title' => 'Daftar Exhaust Fan', 'icon' => 'fan', 'desc' => 'Kelola daftar exhaust fan di gedung.', 'route' => route('exhaustfan.index'), 'btn_text' => 'Lihat Exhaust Fan', 'btn_color' => 'success', 'icon_color' => 'text-success'],
                ['title' => 'Daftar Panel', 'icon' => 'diagram-3', 'desc' => 'Lihat dan kelola daftar panel gedung.', 'route' => route('panel.index'), 'btn_text' => 'Lihat Panel', 'btn_color' => 'danger', 'icon_color' => 'text-danger'],
                ['title' => 'Daftar Staff', 'icon' => 'person-badge', 'desc' => 'Lihat dan kelola data staff.', 'route' => route('staff.index'), 'btn_text' => 'Lihat Staff', 'btn_color' => 'info', 'icon_color' => 'text-info'],
                ['title' => 'Daftar AC', 'icon' => 'snow', 'desc' => 'Kelola daftar AC (Indoor & Outdoor).', 'route' => route('acs.index'), 'btn_text' => 'Lihat AC', 'btn_color' => 'primary', 'icon_color' => 'text-primary'],
                ['title' => 'Riwayat Pekerjaan', 'icon' => 'clock-history', 'desc' => 'Lihat semua catatan pekerjaan staff.', 'route' => route('riwayat.index'), 'btn_text' => 'Lihat Riwayat', 'btn_color' => 'secondary', 'icon_color' => 'text-secondary'],
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
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    transform: translateY(-3px);
    transition: all 0.25s ease-in-out;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@if(count($values) > 0)
const ctx = document.getElementById('meteranChart').getContext('2d');

// 🌈 Gradient Background
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(255, 189, 56, 0.5)');
gradient.addColorStop(1, 'rgba(255, 189, 56, 0.05)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Pemakaian Listrik (KWh)',
            data: @json($values),
            borderColor: '#ffbd38',
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: '#ffbd38',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: '#ffbd38'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: { color: '#555', font: { weight: 'bold' } }
            },
            tooltip: {
                backgroundColor: '#333',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 12,
                borderColor: '#ffbd38',
                borderWidth: 1,
                displayColors: false
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#666', font: { weight: '500' } }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { color: '#666', font: { weight: '500' } },
                title: { display: true, text: 'KWh', color: '#555', font: { weight: 'bold' } }
            }
        },
        animation: {
            duration: 1200,
            easing: 'easeInOutQuart'
        }
    }
});
@endif
</script>
@endpush
@endsection
