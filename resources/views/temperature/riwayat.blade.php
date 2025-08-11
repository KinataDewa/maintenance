@extends('layouts.app')

@section('title', 'Riwayat Suhu Ruangan')

@section('content')
<div class="container">
    <h1 class="page-title">Riwayat Suhu Ruangan</h1>

    @if($logs->isEmpty())
        <div class="alert alert-info rounded-4">Belum ada riwayat suhu ruangan.</div>
    @else
        @php
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->waktu_cek)->format('Y-m-d');
            });
        @endphp
        
        <div class="accordion" id="suhuRuanganAccordion">
            @foreach ($grouped as $tanggal => $logGroup)
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
                         aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#suhuRuanganAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark align-middle">
                                    <thead class="bg-dark text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Ruangan</th>
                                            <th>Titik 1 (°C)</th>
                                            <th>Titik 2 (°C)</th>
                                            <th>Titik 3 (°C)</th>
                                            <th>Waktu</th>
                                            <th>Foto</th>
                                            <th>Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logGroup as $i => $log)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $log->room->nama ?? '-' }}</td>
                                                <td class="text-center">{{ $log->titik_1 }}</td>
                                                <td class="text-center">{{ $log->titik_2 }}</td>
                                                <td class="text-center">{{ $log->titik_3 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->waktu_cek)->translatedFormat('H:i') }}</td>
                                                <td class="text-center">
                                                    @if($log->foto && file_exists(public_path('storage/' . $log->foto)))
                                                        <button class="btn btn-sm btn-outline-primary" onclick="showFoto('{{ asset('storage/' . $log->foto) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                        <a href="{{ asset('storage/' . $log->foto) }}" class="btn btn-sm btn-outline-success" download>
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
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

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Suhu Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Suhu" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showFoto(url) {
        document.getElementById('previewFoto').src = url;
        new bootstrap.Modal(document.getElementById('fotoModal')).show();
    }
</script>
@endsection
