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
    <div class="card shadow-sm mb-5 border-0 rounded-4 overflow-hidden">
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

    {{-- 🔹 Aksi Cepat --}}
    <h5 class="fw-bold mb-3 text-uppercase text-muted">Aksi Cepat</h5>
    <div class="row g-4">
        @php
            $cardsUtama = [
                ['title' => 'Pengaduan', 'icon' => 'exclamation-triangle', 'desc' => 'Laporkan kendala atau keluhan dari ruangan.', 'route' => route('pengaduan.create'), 'btn_color' => 'info', 'icon_color' => 'text-info'],
                ['title' => 'Tenant', 'icon' => 'building', 'desc' => 'Lihat dan kelola data tenant.', 'route' => route('tenants.index'), 'btn_color' => 'primary', 'icon_color' => 'text-primary'],
                ['title' => 'Staff', 'icon' => 'person-badge', 'desc' => 'Lihat dan kelola data staff.', 'route' => route('staff.index'), 'btn_color' => 'success', 'icon_color' => 'text-success'],
                ['title' => 'Perangkat', 'icon' => 'cpu', 'desc' => 'Lihat dan kelola daftar perangkat.', 'route' => route('perangkat.index'), 'btn_color' => 'warning', 'icon_color' => 'text-warning'],
                ['title' => 'Riwayat Pekerjaan', 'icon' => 'clock-history', 'desc' => 'Lihat semua catatan pekerjaan staff.', 'route' => route('riwayat.index'), 'btn_color' => 'secondary', 'icon_color' => 'text-secondary'],
            ];
        @endphp

        {{-- Tampilkan 5 menu utama --}}
        @foreach ($cardsUtama as $card)
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 transition border-top border-4 border-{{ $card['btn_color'] }}">
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
                        <a href="{{ $card['route'] }}" class="btn btn-{{ $card['btn_color'] }} w-100 mt-auto rounded-pill">
                            <i class="bi bi-arrow-right-circle me-1"></i> Buka
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Card Menu Lainnya --}}
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center d-flex justify-content-center align-items-center transition" 
                 style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#menuLainnyaModal">
                <i class="bi bi-grid fs-1 text-secondary mb-2"></i>
                <h6 class="fw-bold mb-0 text-dark">Menu Lainnya</h6>
            </div>
        </div>
    </div>
</div>

{{-- Modal Menu Lainnya --}}
<div class="modal fade" id="menuLainnyaModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Menu Lainnya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          @php
            $menuLainnya = [
                ['title' => 'Pompa Air', 'icon' => 'water', 'route' => route('pompa.index')],
                ['title' => 'Exhaust Fan', 'icon' => 'fan', 'route' => route('exhaustfan.index')],
                ['title' => 'Panel Listrik', 'icon' => 'diagram-3', 'route' => route('panel.index')],
                ['title' => 'AC (Indoor & Outdoor)', 'icon' => 'snow', 'route' => route('acs.index')],
            ];
          @endphp
          @foreach($menuLainnya as $m)
          <div class="col-6 col-md-4">
            <a href="{{ $m['route'] }}" class="text-decoration-none">
              <div class="border rounded-4 p-3 text-center h-100 shadow-sm hover-scale bg-light">
                <i class="bi bi-{{ $m['icon'] }} fs-3 text-dark mb-2"></i>
                <div class="fw-bold text-dark">{{ $m['title'] }}</div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Hover Effect --}}
<style>
.card.transition:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    transform: translateY(-3px);
    transition: all 0.25s ease-in-out;
}
.hover-scale:hover {
    transform: scale(1.03);
    transition: 0.25s;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@if(count($values) > 0)
const ctx = document.getElementById('meteranChart').getContext('2d');
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
            pointBorderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'top' },
        },
        scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true }
        }
    }
});
@endif
</script>
@endpush
@endsection
