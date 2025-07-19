@extends('layouts.app')

@section('title', 'Riwayat Checklist Harian')

@section('content')
<div class="container">
    <h1 class="mb-4">Riwayat Checklist Harian</h1>

    <div class="accordion" id="riwayatAccordion">
        @foreach ($riwayat as $tanggal => $logs)
            @php
                $accordionId = 'collapse-' . \Str::slug($tanggal);
            @endphp
            <div class="accordion-item mb-2 shadow-sm">
                <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                    <button class="accordion-button collapsed bg-dark text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}" aria-expanded="false" aria-controls="{{ $accordionId }}">
                        {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }} ({{ $logs->count() }} aktivitas)
                    </button>
                </h2>
                <div id="{{ $accordionId }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#riwayatAccordion">
                    <div class="accordion-body p-0">
                        <table class="table table-bordered table-striped table-sm mb-0 text-dark">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Aktivitas</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $i => $log)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $log->checklist->aktivitas }}</td>
                                        <td>{{ $log->checklist->jam_mulai }} - {{ $log->checklist->jam_selesai }}</td>
                                        <td>
                                            <span class="badge
                                            @if($log->status == 'belum') bg-secondary
                                            @elseif($log->status == 'progres') bg-warning text-dark
                                            @else bg-success @endif">
                                            {{ ucfirst($log->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form id="form-hapus-{{ $log->id }}" action="{{ route('checklists.destroy', $log->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger btn-hapus-checklist" data-id="{{ $log->id }}">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
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
@endpush

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
