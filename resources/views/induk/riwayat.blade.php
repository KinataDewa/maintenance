@extends('layouts.app')

@section('title', 'Riwayat Meteran Induk PLN')

@section('content')
@push('styles')
<style>
    /* Tabel Riwayat Meteran Modern */
    .table {
        font-size: 0.95rem;
    }

    .table thead {
        background-color: #FFC107;
        color: #111;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        padding: 0.45rem 0.6rem;
    }

    .table tbody tr {
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background-color: #FFF3CD;
    }

    /* Tombol foto */
    .table .btn-outline-primary {
        padding: 0.2rem 0.4rem;
        font-size: 0.8rem;
        line-height: 1;
    }

    /* Responsif horizontal */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table th, .table td {
            font-size: 0.85rem;
            padding: 0.35rem 0.5rem;
        }
    }
</style>
@endpush

<div class="container py-4">
    <h1 class="page-title">Riwayat Meteran Induk PLN</h1>
    <!-- Filter Form -->
    <form method="GET" action="{{ route('meteran-induk.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-filter-circle me-1"></i> Filter
            </button>
            <a href="{{ route('meteran-induk.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- Export Button -->
    <form method="GET" action="{{ route('meteran-induk.export') }}" class="mb-4">
        <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
        <button class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </button>
    </form>

    @if($data->isEmpty())
        <div class="alert alert-info">Belum ada data meteran induk.</div>
    @else
        @php
            $grouped = $data->groupBy('tanggal');
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
                                            <th>Jam</th>
                                            <th>Kwh</th>
                                            <th>Kvar</th>
                                            <th>Cos φ</th>
                                            <th>WBP</th>
                                            <th>LWBP</th>
                                            <th>Total</th>
                                            <th>Deskripsi</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $data->jam }}</td>

                                                {{-- Kwh --}}
                                                <td>
                                                    {{ $data->kwh ?? '-' }}<br>
                                                    @if($data->foto_kwh && file_exists(public_path('storage/' . $data->foto_kwh)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_kwh) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- Kvar --}}
                                                <td>
                                                    {{ $data->kvar ?? '-' }}<br>
                                                    @if($data->foto_kvar && file_exists(public_path('storage/' . $data->foto_kvar)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_kvar) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- Cos φ --}}
                                                <td>
                                                    {{ $data->cosphi ?? '-' }}<br>
                                                    @if($data->foto_cosphi && file_exists(public_path('storage/' . $data->foto_cosphi)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_cosphi) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- WBP --}}
                                                <td>
                                                    {{ $data->wbp ?? '-' }}<br>
                                                    @if($data->foto_wbp && file_exists(public_path('storage/' . $data->foto_wbp)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_wbp) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- LWBP --}}
                                                <td>
                                                    {{ $data->lwbp ?? '-' }}<br>
                                                    @if($data->foto_lwbp && file_exists(public_path('storage/' . $data->foto_lwbp)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_lwbp) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- Total --}}
                                                <td>
                                                    {{ $data->total ?? '-' }}<br>
                                                    @if($data->foto_total && file_exists(public_path('storage/' . $data->foto_total)))
                                                        <button class="btn btn-sm btn-outline-primary mt-1" onclick="showFoto('{{ asset('storage/' . $data->foto_total) }}')">
                                                            <i class="bi bi-image"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <td>{{ $data->keterangan ?? '-' }}</td>
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
