@extends('layouts.app')

@section('title', 'Riwayat Perawatan Exhaust Fan')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Riwayat Perawatan Exhaust Fan</h1>

    {{-- Filter --}}
    <form method="GET" action="{{ route('perawatan-exhaust-fans.riwayat') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <select name="exhaust_fan_id" class="form-select">
                <option value="">Semua Exhaust Fan</option>
                @foreach($exhaustFans as $fan)
                    <option value="{{ $fan->id }}" {{ request('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                        {{ $fan->nama_fan ?? $fan->nama }} - {{ $fan->lokasi ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="Before" {{ request('status') == 'Before' ? 'selected' : '' }}>Before</option>
                <option value="After" {{ request('status') == 'After' ? 'selected' : '' }}>After</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-2 d-flex">
            <button class="btn btn-warning me-2">Filter</button>
            <a href="{{ route('perawatan-exhaust-fans.riwayat') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data perawatan.</div>
    @else
        @php
            $grouped = $riwayat->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });
        @endphp

        <div class="accordion" id="accordionRiwayat">
            @foreach($grouped as $tanggal => $logs)
                @php $id = 'collapse-'.\Str::slug($tanggal); @endphp
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button collapsed bg-dark text-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#{{ $id }}" aria-expanded="false">
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </button>
                    </h2>
                    <div id="{{ $id }}" class="accordion-collapse collapse" data-bs-parent="#accordionRiwayat">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Exhaust Fan</th>
                                            <th>Status</th>
                                            <th>Pengecekan</th>
                                            <th>Perawatan</th>
                                            <th>Foto</th>
                                            <th>Petugas</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $i => $data)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <strong>{{ $data->exhaustFan->nama_fan ?? $data->exhaustFan->nama }}</strong><br>
                                                <small class="text-muted">{{ $data->exhaustFan->lokasi ?? '-' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $data->status == 'Before' ? 'secondary' : 'success' }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if(!empty($data->pengecekan) && is_array($data->pengecekan))
                                                    @foreach($data->pengecekan as $k => $checks)
                                                        <strong>{{ $k }}:</strong> {{ is_array($checks) ? implode(', ', $checks) : $checks }} <br>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($data->perawatan) && is_array($data->perawatan))
                                                    @foreach($data->perawatan as $k => $checks)
                                                        <strong>{{ $k }}:</strong> {{ is_array($checks) ? implode(', ', $checks) : $checks }} <br>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($data->foto) && is_array($data->foto))
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach($data->foto as $f)
                                                            <a href="{{ asset('storage/'.$f) }}" target="_blank">
                                                                <img src="{{ asset('storage/'.$f) }}" style="width:60px;height:60px;object-fit:cover" class="rounded">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $data->user->name ?? '-' }}</td>
                                            <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
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

        <div class="mt-3">
            {{ $riwayat->links() }}
        </div>
    @endif
</div>
@endsection
