@extends('layouts.app')

@section('title', 'Riwayat Pembersihan Panel')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Pembersihan Panel</h1>

    {{-- Filter Form SELALU tampil --}}
    <form method="GET" action="{{ route('panel-cleaning.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="panel_id" class="form-label">Filter Panel</label>
            <select name="panel_id" id="panel_id" class="form-select">
                <option value="">Semua Panel</option>
                @foreach($panels as $p)
                    <option value="{{ $p->id }}" {{ request('panel_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama ?? $p->name ?? 'Tanpa Nama' }} - {{ $p->lokasi ?? $p->location ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2"><i class="bi bi-filter-circle me-1"></i> Filter</button>
            <a href="{{ route('panel-cleaning.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- Hasil filter --}}
    @if($logs->isEmpty())
        <div class="alert alert-info rounded-4">Belum ada riwayat pembersihan panel.</div>
    @else
        @php
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="panelCleaningAccordion">
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
                         aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#panelCleaningAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark align-middle">
                                    <thead class="bg-dark text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Panel</th>
                                            <th>Checklist</th>
                                            <th>Catatan</th>
                                            <th>Foto</th>
                                            <th>Waktu</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logGroup as $i => $log)
                                            @php
                                                $panelNama = ($log->panel->nama ?? $log->panel->name ?? 'Tanpa Nama');
                                                $panelLok  = ($log->panel->lokasi ?? $log->panel->location ?? '-');

                                                $checklist = [];
                                                if($log->debu_bersih) $checklist[] = "Debu sudah dibersihkan";
                                                if($log->luar_bersih) $checklist[] = "Bagian luar panel bersih";
                                                if($log->dalam_rapi) $checklist[] = "Bagian dalam panel rapi";
                                                if($log->tidak_ada_sampah) $checklist[] = "Tidak ada sampah/serpihan tersisa";
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>
                                                    <span class="fw-semibold">{{ $panelNama }}</span><br>
                                                    <span class="text-muted small">{{ $panelLok }}</span>
                                                </td>
                                                <td>
                                                    @if(!empty($checklist))
                                                        <ul class="mb-0 ps-3">
                                                            @foreach($checklist as $item)
                                                                <li>✅ {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-muted">Tidak ada checklist</span>
                                                    @endif
                                                </td>
                                                <td style="max-width:200px;">
                                                    <div class="text-truncate" title="{{ $log->catatan }}">{{ $log->catatan ?? '-' }}</div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        @if($log->foto_before)
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-primary"
                                                                onclick="showFoto('{{ asset('storage/'.$log->foto_before) }}')">
                                                                <i class="bi bi-image"></i> Before
                                                            </button>
                                                        @endif
                                                        @if($log->foto_after)
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-success"
                                                                onclick="showFoto('{{ asset('storage/'.$log->foto_after) }}')">
                                                                <i class="bi bi-image"></i> After
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $log->jam ?? '-' }}</td>
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

    {{-- <div class="mt-3">
        <a href="{{ route('panel-cleaning.create') }}" class="btn btn-primary rounded-3">
            <i class="bi bi-plus-circle"></i> Tambah Log
        </a>
    </div> --}}
</div>

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Pembersihan Panel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Panel" style="max-height: 400px; object-fit: contain;">
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
