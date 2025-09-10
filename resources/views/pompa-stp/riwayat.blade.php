@extends('layouts.app')

@section('title', 'Riwayat Pompa STP')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Riwayat Pengecekan Pompa STP</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Pompa</th>
                    <th>Voltase (V)</th>
                    <th>Suhu (°C)</th>
                    <th>Oli</th>
                    <th>Pulling</th>
                    <th>Motor</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $log->pompa }}</td>
                        <td>{{ $log->voltase }}</td>
                        <td>{{ $log->suhu }}</td>
                        <td>{{ $log->oli }}</td>
                        <td>{{ $log->pulling }}</td>
                        <td>{{ $log->motor }}</td>
                        <td>{{ $log->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $logs->links() }}
</div>
@endsection
