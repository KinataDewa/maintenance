@extends('layouts.app')

@section('title', 'Riwayat Perawatan AC')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Riwayat Perawatan AC</h1>

    @if($perawatanAcs->isEmpty())
        <div class="alert alert-info">Belum ada data perawatan AC.</div>
    @else
        @php
            // Grouping berdasarkan tanggal
            $grouped = $perawatanAcs->groupBy(function($item) {
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
                                            <th>AC</th>
                                            <th>Perangkat</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th>Staff</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    <strong>{{ $data->ac->nama ?? '-' }}</strong><br>
                                                    <small class="text-muted">{{ $data->ac->ruangan ?? '-' }} ({{ $data->ac->merk ?? '-' }})</small>
                                                </td>
                                                <td>{{ $data->lokasi }}</td>
                                                <td>
                                                    <span class="badge bg-{{ strtolower($data->status) == 'after' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($data->status ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $data->catatan ?? '-' }}</td>
                                                <td>{{ $data->user->name ?? '-' }}</td>
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
                                                            <h5 class="modal-title">Detail Perawatan AC - {{ $data->ac->nama ?? '-' }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Petugas:</strong> {{ $data->user->name ?? '-' }}</p>
                                                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                                                            <p><strong>Perangkat:</strong> {{ $data->lokasi }}</p>
                                                            <hr>

                                                            <h6 class="fw-bold">Pengecekan</h6>
                                                            <ul class="list-group mb-3">
                                                                @foreach($data->pengecekan ?? [] as $kategori => $checks)
                                                                    @if(is_array($checks))
                                                                        <li class="list-group-item">
                                                                            <strong>{{ ucfirst($kategori) }}:</strong> {{ implode(', ', $checks) }}
                                                                        </li>
                                                                    @else
                                                                        <li class="list-group-item">{{ $checks }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>

                                                            <h6 class="fw-bold">Perawatan</h6>
                                                            <ul class="list-group">
                                                                @foreach($data->perawatan ?? [] as $kategori => $checks)
                                                                    @if(is_array($checks))
                                                                        <li class="list-group-item">
                                                                            <strong>{{ ucfirst($kategori) }}:</strong> {{ implode(', ', $checks) }}
                                                                        </li>
                                                                    @else
                                                                        <li class="list-group-item">{{ $checks }}</li>
                                                                    @endif
                                                                @endforeach
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
