@extends('layouts.app')

@section('title', 'Riwayat Zat Air STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Zat Air STP</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('zat-stp.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-8 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-filter-circle me-1"></i> Filter
            </button>
            <a href="{{ route('zat-stp.riwayat') }}" class="btn btn-outline-secondary">
                Reset
            </a>
        </div>
    </form>

    <!-- Data -->
    @if($data->isEmpty())
        <div class="alert alert-info">Belum ada data Zat Air STP.</div>
    @else
        @php
            // Group data by tanggal
            $grouped = $data->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $logs)
                @php $accordionId = 'collapse-' . \Str::slug($tanggal); @endphp
                <div class="accordion-item mb-3 shadow-sm border-0">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button collapsed bg-dark text-white fw-bold rounded-top" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}" aria-expanded="false"
                            aria-controls="{{ $accordionId }}">
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </button>
                    </h2>
                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                         aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#riwayatAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover align-middle mb-0 text-dark">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu</th>
                                            <th>Cek pH</th>
                                            <th>Klorin</th>
                                            <th>Bakteri</th>
                                            <th>Lumpur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-secondary">
                                        @foreach ($logs as $i => $item)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>

                                                <!-- Cek pH -->
                                                <td>
                                                    @if($item->cek_ph_nilai)
                                                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-semibold">
                                                            {{ $item->cek_ph_nilai }}
                                                        </span>
                                                    @endif
                                                    @if($item->cek_ph_foto)
                                                        <a href="{{ asset('storage/'.$item->cek_ph_foto) }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
                                                            <i class="bi bi-image"></i> Lihat Foto
                                                        </a>
                                                    @endif
                                                </td>

                                                <!-- Klorin -->
                                                <td>
                                                    @if($item->klorin_nilai)
                                                        <span class="badge rounded-pill bg-info bg-opacity-10 text-info px-3 py-2 fw-semibold">
                                                            {{ $item->klorin_nilai }}
                                                        </span>
                                                    @endif
                                                    @if($item->klorin_foto)
                                                        <a href="{{ asset('storage/'.$item->klorin_foto) }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
                                                            <i class="bi bi-image"></i> Lihat Foto
                                                        </a>
                                                    @endif
                                                </td>

                                                <!-- Bakteri -->
                                                <td>
                                                    @if($item->bakteri_nilai)
                                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 fw-semibold">
                                                            {{ $item->bakteri_nilai }}
                                                        </span>
                                                    @endif
                                                    @if($item->bakteri_foto)
                                                        <a href="{{ asset('storage/'.$item->bakteri_foto) }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
                                                            <i class="bi bi-image"></i> Lihat Foto
                                                        </a>
                                                    @endif
                                                </td>

                                                <!-- Lumpur -->
                                                <td>
                                                    @if($item->lumpur_nilai)
                                                        <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-3 py-2 fw-semibold">
                                                            {{ $item->lumpur_nilai }}
                                                        </span>
                                                    @endif
                                                    @if($item->lumpur_foto)
                                                        <a href="{{ asset('storage/'.$item->lumpur_foto) }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
                                                            <i class="bi bi-image"></i> Lihat Foto
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    /* Custom Modern Badge */
    .badge {
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .accordion-button:not(.collapsed) {
        background-color: #343a40 !important;
        color: #fff !important;
    }
</style>
@endsection
