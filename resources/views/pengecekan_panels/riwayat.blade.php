@extends('layouts.app')

@section('title', 'Riwayat Pengecekan Panel')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Riwayat Pengecekan Panel</h3>

    <div class="table-responsive shadow-sm rounded-4">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Panel</th>
                    <th>Pengecekan</th>
                    <th>Foto</th>
                    <th>Catatan</th>
                    <th>User</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $index => $data)
                <tr>
                    <td>{{ $riwayat->firstItem() + $index }}</td>
                    <td>{{ $data->panel->nama }}<br><small>{{ $data->panel->lokasi }}</small></td>
                    <td>
                        @foreach($data->pengecekan ?? [] as $kategori => $checks)
                            <strong>{{ $kategori }}:</strong> {{ implode(', ', $checks) }}<br>
                        @endforeach
                    </td>
                    <td>
                        @if($data->foto)
                            @foreach($data->foto as $foto)
                                <img src="{{ asset('storage/'.$foto) }}" alt="Foto" width="80" class="me-1 mb-1 rounded">
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $data->catatan ?? '-' }}</td>
                    <td>{{ $data->user->name ?? 'Unknown' }}</td>
                    <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data pengecekan panel</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $riwayat->links() }}
    </div>
</div>
@endsection
