@extends('layouts.app')

@section('title', 'Menu Riwayat')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Aktivitas</h1>

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-4" id="riwayatTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold d-flex align-items-center gap-2" id="harian-tab" data-bs-toggle="tab" data-bs-target="#harian" type="button">
                <i class="bi bi-calendar-check text-primary"></i> Harian
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold d-flex align-items-center gap-2" id="pengecekan-tab" data-bs-toggle="tab" data-bs-target="#pengecekan" type="button">
                <i class="bi bi-search text-success"></i> Pengecekan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold d-flex align-items-center gap-2" id="perawatan-tab" data-bs-toggle="tab" data-bs-target="#perawatan" type="button">
                <i class="bi bi-gear text-warning"></i> Perawatan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold d-flex align-items-center gap-2" id="perbaikan-tab" data-bs-toggle="tab" data-bs-target="#perbaikan" type="button">
                <i class="bi bi-wrench-adjustable text-danger"></i> Perbaikan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold d-flex align-items-center gap-2" id="pengaduan-tab" data-bs-toggle="tab" data-bs-target="#pengaduan" type="button">
                <i class="bi bi-exclamation-triangle text-info"></i> Pengaduan
            </button>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content" id="riwayatTabsContent">

        {{-- HARIAN --}}
        <div class="tab-pane fade show active" id="harian" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                    $harian = [
                        ['title'=>'Checklist Harian On/Off','icon'=>'list-check','color'=>'success','route'=>route('checklist.riwayat')],
                        ['title'=>'Listrik Tenant','icon'=>'lightning-charge','color'=>'warning','route'=>route('meteran.riwayat')],
                        ['title'=>'Induk PLN','icon'=>'plug','color'=>'danger','route'=>route('meteran-induk.riwayat')],
                        ['title'=>'Pemakaian Air','icon'=>'droplet-half','color'=>'primary','route'=>route('pemakaian-air.riwayat')],
                        ['title'=>'Suhu Ruangan','icon'=>'thermometer-half','color'=>'danger','route'=>route('room-temperature-logs.riwayat')],
                    ];
                @endphp

                @foreach($harian as $card)
                    <div class="col">
                        <a href="{{ $card['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PENGECEKAN --}}
        <div class="tab-pane fade" id="pengecekan" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                    $pengecekan = [
                        ['title'=>'Pengecekan AC','icon'=>'snow','color'=>'primary','route'=>route('pengecekan-ac.riwayat')],
                        ['title'=>'Pengecekan Panel','icon'=>'hdd-network','color'=>'warning','route'=>route('pengecekan-panels.riwayat')],
                        ['title'=>'Pengecekan Pompa','icon'=>'tools','color'=>'primary','route'=>route('pengecekan-pompas.riwayat')],
                        ['title'=>'Pengecekan Pompa STP','icon'=>'gear-wide-connected','color'=>'success','route'=>route('pompa-stp.riwayat')],
                        ['title'=>'Pengecekan Mesin STP','icon'=>'cpu','color'=>'info','route'=>route('mesin-stp.riwayat')],
                        ['title'=>'Pengecekan Zat STP','icon'=>'beaker','color'=>'info','route'=>route('zat-stp.riwayat')],
                    ];
                @endphp

                @foreach($pengecekan as $card)
                    <div class="col">
                        <a href="{{ $card['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PERAWATAN --}}
        <div class="tab-pane fade" id="perawatan" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                    $perawatan = [
                        ['title'=>'Perawatan AC','icon'=>'snow','color'=>'primary','route'=>route('perawatan-ac.riwayat')],
                        ['title'=>'Perawatan Exhaust Fan','icon'=>'fan','color'=>'info','route'=>route('perawatan-exhaust-fans.riwayat')],
                        ['title'=>'Perawatan Panel','icon'=>'clipboard-check','color'=>'success','route'=>route('perawatan-panels.riwayat')],
                        ['title'=>'Perawatan Pompa','icon'=>'tools','color'=>'primary','route'=>route('perawatan-pompa.riwayat')],
                    ];
                @endphp

                @foreach($perawatan as $card)
                    <div class="col">
                        <a href="{{ $card['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PERBAIKAN --}}
        <div class="tab-pane fade" id="perbaikan" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                    $perbaikan = [
                        ['title'=>'Perbaikan','icon'=>'wrench-adjustable','color'=>'secondary','route'=>route('perbaikan.riwayat')],
                    ];
                @endphp

                @foreach($perbaikan as $card)
                    <div class="col">
                        <a href="{{ $card['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PENGADUAN --}}
        <div class="tab-pane fade" id="pengaduan" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                    $pengaduan = [
                        [
                            'title' => 'Laporan Pengaduan',
                            'icon' => 'chat-left-dots',
                            'color' => 'info',
                            'route' => route('pengaduan.riwayat'),
                        ],
                    ];
                @endphp

                @foreach($pengaduan as $card)
                    <div class="col">
                        <a href="{{ $card['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm border-0 rounded-4 h-100 transition riwayat-card border-top border-{{ $card['color'] }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $card['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Style --}}
<style>
    .riwayat-card {
        transition: all 0.25s ease-in-out;
    }
    .riwayat-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
        transform: translateY(-3px);
    }
    .nav-tabs .nav-link {
        color: #555;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
        color: #0d6efd;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        font-weight: 600;
        border-bottom: 3px solid #0d6efd;
        background-color: transparent;
    }
</style>
@endsection
