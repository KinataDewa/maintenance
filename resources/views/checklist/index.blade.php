@extends('layouts.app')

@section('title', 'Checklist Harian')

<style>
.card-status::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 5px;
    border-radius: 0.25rem 0 0 0.25rem;
}
.card-status-belum::before {
    background-color: #dee2e6;
}
.card-status-selesai::before {
    background-color: #198754;
}
</style>

@section('content')

<div class="container">
    <h1 class="mb-4">Checklist Harian</h1>

    {{-- TABEL DESKTOP --}}
    <div class="table-responsive shadow-sm rounded d-none d-md-block">
        <table class="table align-middle mb-0 bg-white">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th style="width: 35%;">Aktivitas</th>
                    <th class="text-center" style="width: 15%;">Waktu</th>
                    <th style="width: 25%;">Staff & Status</th>
                    <th class="text-center" style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($checklists as $index => $item)
                <tr style="border-left: 4px solid 
                    @if($item->status == 'selesai') #198754
                    @else #dee2e6 @endif;">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->aktivitas }}</td>
                    <td class="text-center">
                        <span class="badge bg-dark">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</span>
                        <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</span>
                    </td>
                    <td>
                        <form action="{{ route('checklists.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{-- Status --}}
                            <select name="status" class="form-select form-select-sm mt-1">
                                <option value="belum" {{ $item->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data checklist.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CARD MOBILE --}}
    <div class="d-block d-md-none">
        @foreach($checklists as $index => $item)
        <div class="card mb-3 shadow-sm position-relative card-status card-status-{{ $item->status }}">
            <div class="card-body py-3 px-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="fw-semibold text-dark">{{ $index + 1 }}. {{ $item->aktivitas }}</div>
                    <span class="badge 
                        @if($item->status == 'selesai') bg-success
                        @else bg-secondary @endif">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <div class="mb-2 text-muted small">
                    <i class="bi bi-clock me-1"></i>
                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                </div>

                <form action="{{ route('checklists.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Status --}}
                    <select name="status" class="form-select form-select-sm mb-2">
                        <option value="belum" {{ $item->status == 'belum' ? 'selected' : '' }}>Belum</option>
                        {{-- <option value="progres" {{ $item->status == 'progres' ? 'selected' : '' }}>Progres</option> --}}
                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>

                    <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    {{-- TOMBOL SIMPAN SEMUA --}}
<div class="text-end mt-4">
    <form id="simpan-semua-form" action="{{ route('checklists.log.store') }}" method="POST">
        @csrf
        <button type="button" class="btn btn-success shadow-sm px-4" id="btn-simpan-semua">
            <i class="bi bi-save me-1"></i> Simpan Semua Checklist Hari Ini
        </button>
    </form>
</div>


</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btn-simpan-semua').addEventListener('click', function () {
    Swal.fire({
        title: "Simpan semua checklist hari ini?",
        text: "Pastikan semua data sudah terisi dengan benar.",
        icon: "question",
        width: '24em', // ✅ Ukuran popup lebih kecil (default 32em)
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Simpan",
        denyButtonText: "Jangan Simpan",
        customClass: {
            confirmButton: 'btn-confirm',
            denyButton: 'btn-deny',
            popup: 'swal-small'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('simpan-semua-form').submit();
        } else if (result.isDenied) {
            Swal.fire({
                title: "Perubahan tidak disimpan",
                icon: "info",
                width: '24em',
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: 'btn-confirm',
                    popup: 'swal-small'
                },
                buttonsStyling: false
            });
        }
    });
});
</script>

<style>
    .swal-small {
        font-size: 0.9rem !important;
    }
    .btn-confirm {
        background-color: #FFBD38 !important;
        color: black !important;
        border: none;
        padding: 0.4rem 1.1rem;
        border-radius: 0.3rem;
        font-weight: 600;
    }
    .btn-deny {
        background-color: #000 !important;
        color: white !important;
        border: none;
        padding: 0.4rem 1.1rem;
        border-radius: 0.3rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
</style>
@endpush


@push('styles')
<style>
.border-start-5 {
    border-left-width: 5px !important;
}
.border-warning {
    border-left-color: #FFBD38 !important;
}
.border-success {
    border-left-color: #198754 !important;
}
.border-secondary {
    border-left-color: #dee2e6 !important;
}

.card-body {
    font-size: 0.95rem;
}
.card-body .form-select {
    font-size: 0.875rem;
}
.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.6em;
}
@media (max-width: 768px) {
    .card-title {
        font-size: 1rem;
    }
}
</style>
@endpush