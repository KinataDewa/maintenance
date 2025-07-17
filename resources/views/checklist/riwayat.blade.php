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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($logs->sortBy('checklist_id') as $index => $log)
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
                                    <td>
                                        <form method="POST" action="{{ route('checklist.log.hapus', $log->id) }}" class="delete-aktivitas-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete d-flex align-items-center gap-1">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
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

@push('styles')
<style>
    .btn-delete {
        background-color: #fff;
        border: 1px solid #dc3545;
        color: #dc3545;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-aktivitas-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Aktivitas ini akan dihapus dari riwayat!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
