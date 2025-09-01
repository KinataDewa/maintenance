@extends('layouts.app')

@section('title', 'Riwayat Perawatan Pompa')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Perawatan Pompa</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('pompa.maintenance.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="pompa_unit_id" class="form-label">Filter Pompa</label>
            <select name="pompa_unit_id" id="pompa_unit_id" class="form-select">
                <option value="">Semua Pompa</option>
                @foreach($pompas as $pompa)
                    <option value="{{ $pompa->id }}" {{ request('pompa_unit_id') == $pompa->id ? 'selected' : '' }}>
                        {{ $pompa->nama_pompa ?? 'Pompa '.$pompa->id }}
                    </option>
                @endforeach
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
            <a href="{{ route('pompa.maintenance.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    @if($logs->isEmpty())
        <div class="alert alert-info">Belum ada data perawatan pompa.</div>
    @else
        @php
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal_perawatan)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $dayLogs)
                @php $accordionId = 'collapse-' . \Str::slug($tanggal); @endphp
                <div class="accordion-item mb-2 shadow-sm">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button collapsed bg-dark text-white fw-bold" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}" aria-expanded="false"
                            aria-controls="{{ $accordionId }}">
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </button>
                    </h2>
                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                         aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#riwayatAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Pompa</th>
                                            <th>User</th>
                                            <th>Voltase (V)</th>
                                            <th>Suhu (°C)</th>
                                            <th>Tekanan (bar)</th>
                                            <th>Oli</th>
                                            <th>Suara</th>
                                            <th>Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dayLogs as $i => $log)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $log->pompa->nama_pompa ?? 'Pompa '.$log->pompa_unit_id }}</td>
                                                <td>{{ $log->user->name ?? '-' }}</td>
                                                <td>{{ $log->voltase ?? '-' }}</td>
                                                <td>{{ $log->suhu ?? '-' }}</td>
                                                <td>{{ $log->tekanan ?? '-' }}</td>
                                                <td>{{ ucfirst($log->oli ?? '-') }}</td>
                                                <td>{{ ucfirst($log->suara ?? '-') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->tanggal_perawatan)->format('H:i') }}</td>
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
