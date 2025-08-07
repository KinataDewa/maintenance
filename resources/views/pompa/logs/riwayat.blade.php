@extends('layouts.app')

@section('title', 'Riwayat Log Pompa')

@section('content')
<div class="container">
    <h1 class="page-title">Riwayat Log Harian Pompa</h1>

    
    <!-- Data -->
    @if($logs->isEmpty())
        <div class="alert alert-info">Belum ada data log pompa.</div>
    @else
        @php
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="logPompaAccordion">
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
                         aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#logPompaAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Jam</th>
                                            <th>Jenis Pompa</th>
                                            <th>Status</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logGroup as $i => $log)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('H:i') }}</td>
                                                <td>{{ $log->pompaUnit->nama_pompa ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $statusColor = match($log->status) {
                                                            'Baik' => 'success',
                                                            'Perbaikan' => 'warning',
                                                            'Rusak' => 'danger',
                                                            default => 'secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColor }}">
                                                        {{ ucfirst($log->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $log->deskripsi ?? '-' }}</td>
                                                <td>
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
                <h5 class="modal-title">Foto Pompa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Pompa" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showFoto(url) {
        const img = document.getElementById('previewFoto');
        img.src = url;
        const modal = new bootstrap.Modal(document.getElementById('fotoModal'));
        modal.show();
    }
</script>
@endsection
