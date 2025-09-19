@extends('layouts.app')

@section('title', 'Riwayat Perawatan Panel')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Riwayat Perawatan Panel</h1>

    <!-- Filter Form -->
    {{-- <form method="GET" action="{{ route('perawatan-panel.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="panel_id" class="form-label">Filter Panel</label>
            <select name="panel_id" id="panel_id" class="form-select">
                <option value="">Semua Panel</option>
                @foreach($panels as $panel)
                    <option value="{{ $panel->id }}" {{ request('panel_id') == $panel->id ? 'selected' : '' }}>
                        {{ $panel->nama_panel }}
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
            <a href="{{ route('perawatan-panel.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form> --}}

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data perawatan panel.</div>
    @else
        @php
            // Grouping berdasarkan tanggal
            $grouped = $riwayat->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $logs)
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
                                            <th style="width: 50px;">No</th>
                                            <th>Panel</th>
                                            <th>Status</th>
                                            <th>Petugas</th>
                                            <th>Catatan</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    <strong>{{ $data->panel->nama }}</strong><br>
                                                    <small class="text-muted">{{ $data->panel->lokasi }}</small>
                                                </td>
                                                <td>{{ ucfirst($data->status ?? '-') }}</td>
                                                <td>{{ $data->user->name ?? '-' }}</td>
                                                <td>{{ $data->catatan ?? '-' }}</td>
                                                <td>
                                                    @if($data->foto)
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach($data->foto as $foto)
                                                                <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                                                                    <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $data->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title">Detail Perawatan - {{ $data->panel->nama_panel }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Petugas:</strong> {{ $data->user->name ?? '-' }}</p>
                                                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                                                            <hr>

                                                            <!-- Detail Pengecekan -->
                                                            <h6 class="fw-bold">Pengecekan</h6>
                                                            @php $pengecekan = $data->pengecekan ?? []; @endphp
                                                            <ul class="list-group mb-3">
                                                                <li class="list-group-item">
                                                                    <strong>Visual:</strong> 
                                                                    {{ !empty($pengecekan['visual']) ? implode(', ', $pengecekan['visual']) : '-' }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Pengujian:</strong> 
                                                                    {{ !empty($pengecekan['pengujian']) ? implode(', ', $pengecekan['pengujian']) : '-' }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Lingkungan:</strong> 
                                                                    {{ !empty($pengecekan['lingkungan']) ? implode(', ', $pengecekan['lingkungan']) : '-' }}
                                                                </li>
                                                            </ul>

                                                            <!-- Detail Perawatan -->
                                                            <h6 class="fw-bold">Perawatan</h6>
                                                            @php
                                                                $perawatan = $data->perawatan ?? [];
                                                                $fmt = function($val) {
                                                                    if (is_array($val)) {
                                                                        return count($val) ? implode(', ', $val) : '-';
                                                                    }
                                                                    return $val ?? '-';
                                                                };
                                                            @endphp
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Pembersihan:</strong> {{ $fmt($perawatan['pembersihan'] ?? null) }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Pengencangan Koneksi:</strong> {{ $fmt($perawatan['pengencangan_koneksi'] ?? null) }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Penggantian Komponen:</strong> {{ $fmt($perawatan['penggantian_komponen'] ?? null) }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Perbaikan:</strong> {{ $fmt($perawatan['perbaikan'] ?? null) }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Detail -->
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
