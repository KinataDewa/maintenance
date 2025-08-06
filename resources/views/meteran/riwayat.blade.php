@extends('layouts.app')

@section('title', 'Riwayat Meteran Listrik')

@section('content')
<div class="container">
    <h1 class="page-title">Riwayat Meteran Listrik</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('meteran.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="tenant_id" class="form-label">Filter Tenant</label>
            <select name="tenant_id" id="tenant_id" class="form-select">
                <option value="">Semua Tenant</option>
                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}" {{ request('tenant_id') == $tenant->id ? 'selected' : '' }}>
                        {{ $tenant->nama }}
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
            <a href="{{ route('meteran.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- Export Button -->
    <form method="GET" action="{{ route('meteran.export') }}" class="mb-4">
        <input type="hidden" name="tenant_id" value="{{ request('tenant_id') }}">
        <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
        <button class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </button>
    </form>

    <!-- Data -->
    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data meteran listrik.</div>
    @else
        @php
            $grouped = $riwayat->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->waktu_input)->format('Y-m-d');
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
                                            <th>Tenant</th>
                                            <th>Kwh</th>
                                            <th>Jam</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $data->tenant->nama }}</td>
                                                <td>{{ $data->kwh }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->waktu_input)->format('H:i') }}</td>
                                                <td>{{ $data->deskripsi ?? '-' }}</td>
                                                <td>
                                                    @if($data->foto && file_exists(public_path('storage/' . $data->foto)))
                                                        <button class="btn btn-sm btn-outline-primary" onclick="showFoto('{{ asset('storage/' . $data->foto) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                        <a href="{{ asset('storage/' . $data->foto) }}" class="btn btn-sm btn-outline-success" download>
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->user->name ?? '-' }}</td>
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
                <h5 class="modal-title">Foto Meteran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Meteran" style="max-height: 400px; object-fit: contain;">
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
