{{-- @extends('layouts.app')

@section('title', 'Perawatan STP')

@section('content')
<div class="container py-3" style="font-family: 'Poppins', sans-serif;">
    <h4 class="page-title mb-3">Perawatan STP</h4>

    <form action="{{ route('stp.perawatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Cek pH -->
        <div class="card shadow-sm border-0 rounded-3 mb-3 border-start border-3 border-primary">
            <div class="card-body py-3 px-3">
                <h6 class="fw-bold text-dark mb-3">Cek pH</h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Nilai pH</label>
                    <input type="number" step="0.01" name="ph" class="form-control form-control-sm rounded-3"
                           placeholder="Masukkan nilai pH" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Foto Cek pH</label>
                    <input type="file" name="ph_foto" class="form-control form-control-sm rounded-3" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Klorin -->
        <div class="card shadow-sm border-0 rounded-3 mb-3 border-start border-3 border-success">
            <div class="card-body py-3 px-3">
                <h6 class="fw-bold text-dark mb-3">Klorin</h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Hasil Klorin</label>
                    <input type="text" name="klorin" class="form-control form-control-sm rounded-3"
                           placeholder="Masukkan hasil pengukuran klorin" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Foto Klorin</label>
                    <input type="file" name="klorin_foto" class="form-control form-control-sm rounded-3" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Bakteri -->
        <div class="card shadow-sm border-0 rounded-3 mb-3 border-start border-3 border-warning">
            <div class="card-body py-3 px-3">
                <h6 class="fw-bold text-dark mb-3">Bakteri</h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Hasil Pemeriksaan Bakteri</label>
                    <input type="text" name="bakteri" class="form-control form-control-sm rounded-3"
                           placeholder="Masukkan hasil pemeriksaan bakteri" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Foto Bakteri</label>
                    <input type="file" name="bakteri_foto" class="form-control form-control-sm rounded-3" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Pembersihan Lumpur -->
        <div class="card shadow-sm border-0 rounded-3 mb-3 border-start border-3 border-info">
            <div class="card-body py-3 px-3">
                <h6 class="fw-bold text-dark mb-3">Pembersihan Lumpur</h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Keterangan</label>
                    <textarea name="lumpur" class="form-control form-control-sm rounded-3" rows="2"
                              placeholder="Tambahkan keterangan pembersihan lumpur" required></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Foto Pembersihan Lumpur</label>
                    <input type="file" name="lumpur_foto" class="form-control form-control-sm rounded-3" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-warning btn-sm text-white shadow-sm px-4">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
        </div> 
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('title', 'Perawatan STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Perawatan STP</h1>

    <form action="{{ route('stp.perawatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Checklist Dynamic -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <h5 class="mb-3 fw-semibold text-secondary">Pilih item perawatan hari ini</h5>

                @php
                    $items = [
                        'cek_ph' => 'Cek pH',
                        'klorin' => 'Klorin',
                        'bakteri' => 'Bakteri',
                        'lumpur' => 'Pembersihan Lumpur',
                    ];
                @endphp

                @foreach($items as $key => $label)
                <div class="mb-4 pb-3 border-bottom">
                    <div class="form-check">
                        <input class="form-check-input toggle-input" type="checkbox" id="{{ $key }}Check" data-target="#{{ $key }}Form">
                        <label class="form-check-label fw-semibold" for="{{ $key }}Check">
                            {{ $label }}
                        </label>
                    </div>

                    <!-- Hidden input section -->
                    <div class="mt-3 p-3 rounded bg-light d-none" id="{{ $key }}Form">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nilai {{ $label }}</label>
                            <input type="text" name="{{ $key }}_nilai" class="form-control rounded-pill shadow-sm" placeholder="Masukkan nilai {{ strtolower($label) }}">
                        </div>
                        <div>
                            <label class="form-label text-muted">Foto {{ $label }}</label>
                            <input type="file" name="{{ $key }}_foto" class="form-control rounded shadow-sm">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-warning btn-sm text-white shadow-sm px-4">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
        </div> 
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".toggle-input").forEach(cb => {
        cb.addEventListener("change", function() {
            const target = document.querySelector(this.dataset.target);
            if (this.checked) {
                target.classList.remove("d-none");
            } else {
                target.classList.add("d-none");
                target.querySelectorAll("input").forEach(inp => inp.value = "");
            }
        });
    });
});
</script>
@endpush
