@extends('layouts.app')

@section('title', 'Riwayat Mesin STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Mesin STP</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('mesin-stp.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="mesin" class="form-label">Filter Mesin</label>
            <select name="mesin" id="mesin" class="form-select">
                <option value="">Semua Mesin</option>
                <option value="Mesin STP 1" {{ request('mesin') == 'Mesin STP 1' ? 'selected' : '' }}>Mesin STP 1</option>
                <option value="Mesin STP 2" {{ request('mesin') == 'Mesin STP 2' ? 'selected' : '' }}>Mesin STP 2</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-filter-circle me-1"></i> Filter
            </button>
            <a href="{{ route('mesin-stp.riwayat') }}" class="btn btn-outline-secondary">
                Reset
            </a>
        </div>
    </form>

    <!-- Data -->
    @if($logs->isEmpty())
        <div class="alert alert-info">Belum ada data mesin STP.</div>
    @else
        @php
            // Group data by tanggal
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $dataLogs)
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
                                            <th>Mesin</th>
                                            <th>Oli</th>
                                            <th>Vanbelt</th>
                                            <th>Suhu (°C)</th>
                                            <th>Suara</th>
                                            <th>Catatan</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-secondary">
                                        @foreach ($dataLogs as $i => $log)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('H:i') }}</td>
                                                <td>{{ $log->mesin }}</td>

                                                <!-- Badge Oli -->
                                                <td>
                                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-semibold">
                                                        {{ $log->oli }}
                                                    </span>
                                                </td>

                                                <!-- Badge Vanbelt -->
                                                <td>
                                                    <span class="badge rounded-pill bg-info bg-opacity-10 text-info px-3 py-2 fw-semibold">
                                                        {{ $log->vanbelt }}
                                                    </span>
                                                </td>

                                                <!-- Suhu -->
                                                <td>{{ $log->suhu }}</td>

                                                <!-- Badge Suara -->
                                                <td>
                                                    @if($log->suara == 'Halus')
                                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 fw-semibold">
                                                            Halus
                                                        </span>
                                                    @elseif($log->suara == 'Bising Ringan')
                                                        <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-3 py-2 fw-semibold">
                                                            Bising Ringan
                                                        </span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger px-3 py-2 fw-semibold">
                                                            Bising Berat
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Catatan -->
                                                <td>{{ $log->catatan ?? '-' }}</td>

                                                <!-- Staff -->
                                                <td>{{ $log->user->name ?? '-' }}</td>
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
    .badge-modern {
        border-radius: 50px;
        padding: 0.4rem 0.8rem;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Table Styling */
    .table thead th {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid #dee2e6; /* Garis kolom */
    }

    .table tbody td {
        border: 1px solid #dee2e6; /* Garis baris dan kolom */
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Accordion Styling */
    .accordion-button:not(.collapsed) {
        background-color: #343a40 !important;
        color: #fff !important;
    }

    .accordion-button {
        font-weight: 600;
    }
</style>
@endsection
