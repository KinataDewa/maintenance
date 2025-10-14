@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Pengaduan</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('pengaduan.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-8 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-filter-circle me-1"></i> Filter
            </button>
            <a href="{{ route('pengaduan.riwayat') }}" class="btn btn-outline-secondary">
                Reset
            </a>
        </div>
    </form>

    <!-- Data -->
    @if($pengaduans->isEmpty())
        <div class="alert alert-info">Belum ada data pengaduan.</div>
    @else
        @php
            // Group data by tanggal
            $grouped = $pengaduans->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $items)
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
                                            <th>Jenis Kendala</th>
                                            <th>Perangkat</th>
                                            <th>Ruangan</th>
                                            <th>PIC</th>
                                            <th>Status</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-secondary">
                                        @foreach ($items as $i => $p)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $p->jenis_kendala }}</td>
                                                <td>{{ $p->perangkat_tipe ?? '-' }}</td>
                                                <td>{{ $p->room->nama ?? '-' }}</td>
                                                <td>
                                                    {{ $p->pic_nama }}
                                                    @if($p->pic_telp)
                                                        <br><small class="text-muted">{{ $p->pic_telp }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-{{ $p->status == 'Selesai' ? 'success' : 'warning' }} bg-opacity-10 text-{{ $p->status == 'Selesai' ? 'success' : 'warning' }} px-3 py-2 fw-semibold">
                                                        {{ $p->status ?? 'Menunggu' }}
                                                    </span>
                                                </td>
                                                <td>{{ $p->deskripsi ?? '-' }}</td>
                                                <td>
                                                    @if($p->foto)
                                                        <a href="{{ asset('storage/' . $p->foto) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-image"></i> Lihat
                                                        </a>
                                                    @else
                                                        <small class="text-muted">Tidak ada</small>
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
    /* Modern look for badges and tables */
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
