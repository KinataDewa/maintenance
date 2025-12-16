@extends('layouts.app')

@section('title', 'Riwayat Pengecekan Panel')

@section('content')

@php
function isAbnormal($value, $min = null, $max = null) {
    if ($value === null) return false;
    if ($min !== null && $value < $min) return true;
    if ($max !== null && $value > $max) return true;
    return false;
}

function hasAbnormal($logs) {
    foreach ($logs as $data) {
        if (
            isAbnormal($data->tegangan, 210, 240) ||
            isAbnormal($data->arus, null, 100) ||
            isAbnormal($data->suhu, null, 60) ||
            isAbnormal($data->thermal_imaging, null, 70)
        ) {
            return true;
        }
    }
    return false;
}
@endphp


<div class="container py-4">
    <h3 class="page-title mb-2">Riwayat Pengecekan Panel</h3>

    <small class="text-muted d-block mb-3">
        Nilai berwarna <span class="text-danger fw-bold">merah</span> menunjukkan kondisi tidak normal
    </small>

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
                        <button class="accordion-button collapsed bg-dark text-white fw-bold d-flex justify-content-between align-items-center"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $accordionId }}">

                            <span>
                                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                            </span>

                            @if(hasAbnormal($logs))
                                <span class="badge bg-danger ms-2">
                                    ⚠ WARNING
                                </span>
                            @endif
                        </button>
                    </h2>

                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                         data-bs-parent="#riwayatAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th style="width:50px;">No</th>
                                            <th>Panel</th>
                                            <th>Pengecekan</th>
                                            <th>Tegangan (V)</th>
                                            <th>Arus (A)</th>
                                            <th>Suhu (°C)</th>
                                            <th>Thermal Imaging (°C)</th>
                                            <th>Petugas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $i => $data)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>

                                                <td>
                                                    <strong>{{ $data->panel->nama ?? '-' }}</strong><br>
                                                    <small class="text-muted">{{ $data->panel->lokasi ?? '-' }}</small>
                                                </td>

                                                <td>
                                                    @foreach($data->pengecekan ?? [] as $kategori => $checks)
                                                        <strong>{{ ucfirst($kategori) }}:</strong>
                                                        {{ is_array($checks) ? implode(', ', $checks) : $checks }}<br>
                                                    @endforeach
                                                </td>

                                                {{-- SARAN 1: Tooltip + warna merah --}}
                                                <td class="{{ isAbnormal($data->tegangan,210,240) ? 'text-danger fw-bold' : '' }}"
                                                    title="Batas normal: 210–240 V">
                                                    {{ $data->tegangan ?? '-' }}
                                                </td>

                                                <td class="{{ isAbnormal($data->arus,null,100) ? 'text-danger fw-bold' : '' }}"
                                                    title="Batas normal: ≤ 100 A">
                                                    {{ $data->arus ?? '-' }}
                                                </td>

                                                <td class="{{ isAbnormal($data->suhu,null,60) ? 'text-danger fw-bold' : '' }}"
                                                    title="Batas normal: ≤ 60 °C">
                                                    {{ $data->suhu ?? '-' }}
                                                </td>

                                                <td class="{{ isAbnormal($data->thermal_imaging,null,70) ? 'text-danger fw-bold' : '' }}"
                                                    title="Batas normal: ≤ 70 °C">
                                                    {{ $data->thermal_imaging ?? '-' }}
                                                </td>

                                                <td>{{ $data->user->name ?? 'Unknown' }}</td>

                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#detailModal{{ $data->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            {{-- SARAN 2: Konsisten di Modal --}}
                                            <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title">
                                                                Detail Pengecekan - {{ $data->panel->nama ?? 'Panel' }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <p><strong>Petugas:</strong> {{ $data->user->name ?? '-' }}</p>
                                                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                                                            <hr>

                                                            <h6 class="fw-bold">Tegangan</h6>
                                                            <p class="{{ isAbnormal($data->tegangan,210,240) ? 'text-danger fw-bold' : '' }}">
                                                                {{ $data->tegangan ?? '-' }} V
                                                            </p>

                                                            <h6 class="fw-bold">Arus</h6>
                                                            <p class="{{ isAbnormal($data->arus,null,100) ? 'text-danger fw-bold' : '' }}">
                                                                {{ $data->arus ?? '-' }} A
                                                            </p>

                                                            <h6 class="fw-bold">Suhu</h6>
                                                            <p class="{{ isAbnormal($data->suhu,null,60) ? 'text-danger fw-bold' : '' }}">
                                                                {{ $data->suhu ?? '-' }} °C
                                                            </p>

                                                            <h6 class="fw-bold">Thermal Imaging</h6>
                                                            <p class="{{ isAbnormal($data->thermal_imaging,null,70) ? 'text-danger fw-bold' : '' }}">
                                                                {{ $data->thermal_imaging ?? '-' }} °C
                                                            </p>

                                                            <hr>
                                                            <h6 class="fw-bold">Pengecekan</h6>
                                                            @if(!empty($data->pengecekan))
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END MODAL --}}
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
