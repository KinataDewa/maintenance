@extends('layouts.app')

@section('title', 'Riwayat Exhaust Fan')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Exhaust Fan</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('exhaustfanlogs.riwayat') }}" class="row g-2 mb-4">
    <div class="col-md-4">
        <label for="tanggal" class="form-label">Filter Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
    </div>

    <div class="col-md-4">
        <label for="exhaust_fan_id" class="form-label">Filter Exhaust Fan</label>
        <select name="exhaust_fan_id" id="exhaust_fan_id" class="form-select">
            <option value="">-- Semua --</option>
            @foreach($exhaustFans as $fan)
                <option value="{{ $fan->id }}" {{ request('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                    {{ $fan->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-warning me-2">
            <i class="bi bi-filter-circle me-1"></i> Filter
        </button>
        <a href="{{ route('exhaustfanlogs.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>



    @if($logs->isEmpty())
        <div class="alert alert-info">Belum ada data riwayat exhaust fan.</div>
    @else
        @php
            $grouped = $logs->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="riwayatAccordion">
            @foreach ($grouped as $tanggal => $logsPerTanggal)
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
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark align-middle">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Exhaust Fan</th>
                                            <th>Jam</th>
                                            <th>Status</th>
                                            <th>Perawatan</th>
                                            <th>Foto</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logsPerTanggal as $i => $log)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $log->exhaustFan->nama }}</td>
                                                <td>{{ $log->created_at->format('H:i') }}</td>
                                                <td>{{ ucfirst($log->status) }}</td>
                                                <td>
                                                    @php
                                                        $perawatanItems = explode(',', $log->perawatan);
                                                    @endphp
                                                    <ul class="mb-0 ps-3">
                                                        @foreach ($perawatanItems as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    @if ($log->foto_pembersihan && file_exists(public_path('storage/' . $log->foto_pembersihan)))
                                                        <button class="btn btn-sm btn-outline-primary" onclick="showFoto('{{ asset('storage/' . $log->foto_pembersihan) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                        <a href="{{ asset('storage/' . $log->foto_pembersihan) }}" class="btn btn-sm btn-outline-success" download>
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

        {{ $logs->withQueryString()->links() }}
    @endif
</div>

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Pembersihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewFoto" src="" class="img-fluid rounded" alt="Foto Pembersihan" style="max-height: 400px; object-fit: contain;">
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
