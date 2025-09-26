@extends('layouts.app')

@section('title', 'Riwayat Pengecekan Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title mb-4">Riwayat Pengecekan Exhaust Fan</h3>

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data pengecekan exhaust fan.</div>
    @else
        @php
            // Grouping data berdasarkan tanggal
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
                                            <th style="width:50px;">No</th>
                                            <th>Exhaust Fan</th>
                                            <th>Daya Hisap (CFM)</th>
                                            <th>Suhu (°C)</th>
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
                                                    <strong>{{ $data->exhaustFan->nama_fan ?? $data->exhaustFan->nama }}</strong><br>
                                                    <small class="text-muted">{{ $data->exhaustFan->lokasi ?? '-' }}</small>
                                                </td>
                                                <td>{{ $data->daya_hisap ?? '-' }}</td>
                                                <td>{{ $data->suhu ?? '-' }}</td>
                                                <td>{{ $data->user->name ?? '-' }}</td>
                                                <td>{{ $data->catatan ?? '-' }}</td>
                                                <td>
                                                    @if($data->foto && is_array($data->foto))
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
                                                            <h5 class="modal-title">Detail Pengecekan - {{ $data->exhaustFan->nama_fan ?? $data->exhaustFan->nama }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Petugas:</strong> {{ $data->user->name ?? '-' }}</p>
                                                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                                                            <hr>

                                                            <h6 class="fw-bold">Daya Hisap</h6>
                                                            <p>{{ $data->daya_hisap ?? '-' }} CFM</p>

                                                            <h6 class="fw-bold">Suhu</h6>
                                                            <p>{{ $data->suhu ?? '-' }} °C</p>

                                                            <hr>
                                                            <h6 class="fw-bold">Pengecekan</h6>
                                                            @if(!empty($data->pengecekan) && is_array($data->pengecekan))
                                                                <ul class="list-group mb-3">
                                                                    @foreach($data->pengecekan as $kategori => $checks)
                                                                        <li class="list-group-item">
                                                                            <strong>{{ ucfirst($kategori) }}:</strong> 
                                                                            {{ is_array($checks) ? implode(', ', $checks) : $checks }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <p class="text-muted">Tidak ada data pengecekan</p>
                                                            @endif

                                                            <h6 class="fw-bold">Catatan</h6>
                                                            <p>{{ $data->catatan ?? '-' }}</p>

                                                            <hr>
                                                            <h6 class="fw-bold">Foto</h6>
                                                            @if($data->foto && is_array($data->foto))
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @foreach($data->foto as $foto)
                                                                        <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                                                                            <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <p class="text-muted">Tidak ada foto</p>
                                                            @endif
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
