@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4 fw-bold">Riwayat Pengaduan</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('pengaduan.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>

        <div class="col-md-3">
            <label for="perangkat_tipe" class="form-label">Perangkat</label>
            <select name="perangkat_tipe" id="perangkat_tipe" class="form-select">
                <option value="">-- Semua Perangkat --</option>
                @php
                    $perangkatOptions = ['AC','ExhaustFan','Panel','Perangkat','PompaUnit','Perbaikan','Lainnya'];
                @endphp
                @foreach($perangkatOptions as $pt)
                    <option value="{{ $pt }}" {{ request('perangkat_tipe') == $pt ? 'selected' : '' }}>{{ $pt }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="room_id" class="form-label">Ruangan</label>
            <select name="room_id" id="room_id" class="form-select">
                <option value="">-- Semua Ruangan --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->nama ?? $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-filter-circle me-1"></i> Filter
            </button>
            <a href="{{ route('pengaduan.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

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
            @foreach($grouped as $tanggal => $items)
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
                                            <th>Pelapor</th>
                                            <th>Status</th>
                                            <th>Progres</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-secondary">
                                        @foreach($items as $i => $p)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $p->jenis_kendala }}</td>
                                                <td>
                                                    @if($p->perangkat_tipe === 'Lainnya' && $p->perangkat_lainnya)
                                                        <span class="text-dark fw-semibold">{{ $p->perangkat_lainnya }}</span>
                                                    @else
                                                        {{ $p->perangkat_tipe ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$p->room_id && $p->lokasi_lainnya)
                                                        <span class="text-dark fw-semibold">{{ $p->lokasi_lainnya }}</span>
                                                    @elseif($p->room)
                                                        {{ $p->room->nama ?? $p->room->name }}
                                                    @else
                                                        <small class="text-muted">-</small>
                                                    @endif
                                                </td>
                                                <td>{{ $p->pic_nama }}<br><small>{{ $p->pic_telp ?? '-' }}</small></td>
                                                <td>
                                                    <span class="badge rounded-pill bg-{{ $p->status == 'Selesai' ? 'success' : 'warning' }} bg-opacity-10 text-{{ $p->status == 'Selesai' ? 'success' : 'warning' }} px-3 py-2 fw-semibold">
                                                        {{ $p->status ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-semibold">
                                                        {{ $p->progres ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($p->foto)
                                                        <!-- Tombol trigger -->
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                                data-bs-toggle="modal" data-bs-target="#fotoModal-{{ $p->id }}">
                                                            <i class="bi bi-image"></i> Lihat
                                                        </button>

                                                        <!-- Modal Bootstrap -->
                                                        <div class="modal fade" id="fotoModal-{{ $p->id }}" tabindex="-1" aria-labelledby="fotoModalLabel-{{ $p->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                                                    <div class="modal-header bg-dark text-white">
                                                                        <h5 class="modal-title" id="fotoModalLabel-{{ $p->id }}">
                                                                            Foto Pengaduan #{{ $p->id }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center bg-light">
                                                                        <img src="{{ asset('storage/'.$p->foto) }}" 
                                                                            alt="Foto Pengaduan" 
                                                                            class="img-fluid rounded-3 shadow-sm" 
                                                                            style="max-height: 70vh; object-fit: contain;">
                                                                    </div>
                                                                    <div class="modal-footer bg-light">
                                                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                                                                            <i class="bi bi-x-circle me-1"></i> Tutup
                                                                        </button>
                                                                        <a href="{{ asset('storage/'.$p->foto) }}" target="_blank" class="btn btn-primary rounded-pill">
                                                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <small class="text-muted">Tidak ada</small>
                                                    @endif
                                                </td>
                                                <td>
                                                @if(in_array(auth()->user()->role, ['admin','staff']))
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('pengaduan.edit', $p->id) }}" class="btn btn-sm btn-outline-primary mb-1">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>

                                                    <!-- Tombol History -->
                                                    <a href="{{ route('pengaduan.history', ['pengaduan_id' => $p->id]) }}" 
                                                    class="btn btn-sm btn-outline-info mb-1">
                                                        <i class="bi bi-clock-history"></i> History
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
