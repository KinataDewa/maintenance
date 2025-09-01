@extends('layouts.app')

@section('title', 'Riwayat Pemakaian Air')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Pemakaian Air</h1>

    <!-- Filter Form --> 
    <!-- Filter Form -->
<form method="GET" action="{{ route('pemakaian-air.riwayat') }}" class="row g-2 mb-4">
    <div class="col-md-4">
        <label for="sumber_air" class="form-label">Jenis Pompa</label>
        <select name="sumber_air" id="sumber_air" class="form-select">
            <option value="">Semua Jenis</option>
            <option value="PDAM" {{ request('sumber_air') == 'PDAM' ? 'selected' : '' }}>PDAM</option>
            <option value="STP" {{ request('sumber_air') == 'STP' ? 'selected' : '' }}>STP</option>
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
        <a href="{{ route('pemakaian-air.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

    <!-- Data -->
    @if($data->isEmpty())
        <div class="alert alert-info">Belum ada data pemakaian air.</div>
    @else
        @php
            $grouped = $data->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
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
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Sumber Air</th>
                                            <th>Meteran</th>
                                            <th>Deskripsi</th>
                                            <th>Jam</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $item)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $item->user->name ?? '-' }}</td>
                                                <td><span class="badge bg-warning text-dark">{{ $item->sumber_air }}</span></td>
                                                <td>{{ $item->meteran }}</td>
                                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                                <td>{{ $item->waktu }}</td>
                                                <td>
                                                    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                                        <button class="btn btn-sm btn-outline-primary" onclick="showFoto('{{ asset('storage/' . $item->foto) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                        <a href="{{ asset('storage/' . $item->foto) }}" class="btn btn-sm btn-outline-success" download>
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
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

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Pemakaian Air</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Pemakaian Air" style="max-height: 400px; object-fit: contain;">
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
