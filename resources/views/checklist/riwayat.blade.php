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
                                <th style="width:10%;">Aksi</th>
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
                                    <td class="text-center">
                                        <form id="form-hapus-{{ $log->id }}" action="{{ route('checklist-log.destroy', $log->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm d-flex align-items-center gap-1 text-white btn-hapus-checklist" data-id="{{ $log->id }}" style="background-color: #d33;">
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

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-hapus-checklist').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data ini tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FFBD38",
                    cancelButtonColor: "#000000",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-hapus-' + id).submit();
                    }
                });
            });
        });
    });
</script>
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

