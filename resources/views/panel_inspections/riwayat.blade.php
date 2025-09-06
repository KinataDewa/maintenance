@extends('layouts.app')

@section('title', 'Riwayat Pengecekan Panel')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Riwayat Pengecekan Panel</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('panel-inspections.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="panel_id" class="form-label">Filter Panel</label>
            <select name="panel_id" id="panel_id" class="form-select">
                <option value="">Semua Panel</option>
                @foreach($panels as $panel)
                    <option value="{{ $panel->id }}" {{ request('panel_id') == $panel->id ? 'selected' : '' }}>
                        {{ $panel->nama }}
                    </option>
                @endforeach
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
            <a href="{{ route('panel-inspections.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data pengecekan panel.</div>
    @else
        @php
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
                                            <th>No</th>
                                            <th>Panel</th>
                                            <th>Petugas</th>
                                            <th>Suhu MCB (°C)</th>
                                            <th>Suhu Terminal (°C)</th>
                                            <th>catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $data->panel->nama }}</td>
                                                <td>{{ $data->user->name ?? '-' }}</td>
                                                <td>{{ $data->suhu_mcb ?? '-' }}</td>
                                                <td>{{ $data->suhu_terminal ?? '-' }}</td>
                                                <td>{{ $data->catatan ?? '-' }}</td>
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
                                                            <h5 class="modal-title">Detail Pengecekan - {{ $data->panel->nama }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Petugas:</strong> {{ $data->user->name ?? '-' }}</p>
                                                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                                                            <hr>
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Kabel terkupas:</strong> {{ $data->kabel_terkupas ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_kabel_terkupas }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>MCB rusak:</strong> {{ $data->mcb_rusak ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_mcb_rusak }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Panel bersih:</strong> {{ $data->panel_bersih ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_panel_bersih }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Baut terminal:</strong> {{ $data->baut_terminal ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_baut_terminal }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Grounding baik:</strong> {{ $data->grounding_baik ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_grounding }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>MCB normal:</strong> {{ $data->mcb_normal ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_mcb_normal }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Lampu indikator:</strong> {{ $data->lampu_indikator ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_lampu_indikator }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Panel tertutup rapat:</strong> {{ $data->panel_tertutup ? 'OK' : 'Tidak OK' }} | {{ $data->catatan_panel_tertutup }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
