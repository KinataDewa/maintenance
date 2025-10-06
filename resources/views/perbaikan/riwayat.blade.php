@extends('layouts.app')

@section('title', 'Riwayat Perbaikan')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Riwayat Perbaikan</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif

    {{-- Filter Section --}}
    <div class="card shadow-sm mb-4 rounded-4">
        <div class="card-body">
            <form method="GET" action="{{ route('perbaikan.riwayat') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Filter Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="jenis_perangkat" class="form-label">Jenis Perangkat</label>
                    <select id="jenis_perangkat" name="jenis_perangkat" class="form-select">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisPerangkatList as $jenis)
                            <option value="{{ $jenis }}" {{ request('jenis_perangkat') == $jenis ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $jenis)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 text-md-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('perbaikan.riwayat') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-repeat"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Section --}}
    @if($perbaikans->isEmpty())
        <div class="alert alert-info rounded-4">Belum ada data perbaikan.</div>
    @else
        @php
            // Grouping berdasarkan tanggal
            $grouped = $perbaikans->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $logs)
                @php $accordionId = 'collapse-' . \Str::slug($tanggal); @endphp

                <div class="accordion-item mb-2 shadow-sm rounded-4 overflow-hidden">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button collapsed bg-dark text-white fw-bold" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}"
                            aria-expanded="false" aria-controls="{{ $accordionId }}">
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </button>
                    </h2>

                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                         aria-labelledby="heading-{{ $loop->index }}"
                         data-bs-parent="#riwayatAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 align-middle">
                                    <thead class="bg-dark text-white">
                                        <tr class="text-center">
                                            <th style="width: 40px;">No</th>
                                            <th>Jenis Perangkat</th>
                                            <th>Nama</th>
                                            <th>Kerusakan</th>
                                            <th>Tindakan</th>
                                            <th>Status</th>
                                            <th>Biaya (Rp)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $item)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td class="text-capitalize">{{ str_replace('_', ' ', $item->jenis_perangkat) }}</td>
                                                <td>{{ $item->nama_perangkat ?? '-' }}</td>
                                                <td>{{ $item->jenis_kerusakan }}</td>
                                                <td>{{ $item->tindakan_perbaikan ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge 
                                                        @if($item->status == 'belum') bg-secondary 
                                                        @elseif($item->status == 'proses') bg-warning text-dark 
                                                        @else bg-success @endif">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">{{ $item->biaya ? number_format($item->biaya, 0, ',', '.') : '-' }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content rounded-4">
                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title">Edit Status & Biaya</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('perbaikan.updateStatus', $item->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select name="status" class="form-select">
                                                                        <option value="belum" {{ $item->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                                                        <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                                        <option value="sudah" {{ $item->status == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Biaya (Rp)</label>
                                                                    <input type="number" name="biaya" step="100" class="form-control"
                                                                        value="{{ $item->biaya }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
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
