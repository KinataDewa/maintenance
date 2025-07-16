@extends('layouts.app')

@section('title', 'Riwayat Checklist Harian')

@section('content')
<div class="container">
    <h1 class="mb-4">Riwayat Checklist Harian</h1>

    @forelse($riwayat as $tanggal => $logs)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <strong>{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</strong>
                <span>{{ $logs->count() }} Aktivitas</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:5%;">No</th>
                                <th>Aktivitas</th>
                                <th style="width:20%;">Status</th>
                                <th>Staff</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $index => $log)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $log->checklist->aktivitas }}</td>
                                    <td>
                                        <span class="badge
                                            @if($log->status == 'belum') bg-secondary
                                            @elseif($log->status == 'progres') bg-warning text-dark
                                            @else bg-success @endif">
                                            {{ ucfirst($log->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach($log->staff as $staff)
                                            <span class="badge bg-dark me-1">{{ $staff->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada riwayat checklist harian.</div>
    @endforelse
</div>
@endsection
