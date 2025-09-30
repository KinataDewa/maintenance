@extends('layouts.app')

@section('title', 'Input Zat Air STP')

@section('content')
<div class="container py-4" style="font-family: 'Poppins', sans-serif;">
    <h1 class="page-title mb-4 fw-bold text-dark">Input Zat Air STP</h1>

    <form action="{{ route('zat-stp.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="mb-4 fw-semibold text-secondary">Pilih item pengecekan hari ini</h5>

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
                        <!-- Checkbox -->
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-input" type="checkbox" role="switch" id="{{ $key }}Check" data-target="#{{ $key }}Form">
                            <label class="form-check-label fw-semibold text-dark ms-2" for="{{ $key }}Check">
                                {{ $label }}
                            </label>
                        </div>

                        <!-- Hidden input section -->
                        <div class="mt-3 p-3 rounded-3 bg-light d-none border" id="{{ $key }}Form">
                            <div class="mb-3">
                                <label class="form-label small text-muted">Nilai {{ $label }}</label>
                                <input type="text" name="{{ $key }}_nilai" class="form-control rounded-pill shadow-sm" placeholder="Masukkan nilai {{ strtolower($label) }}">
                            </div>
                            <div>
                                <label class="form-label small text-muted">Foto {{ $label }}</label>
                                <input type="file" name="{{ $key }}_foto" class="form-control rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
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

@push('styles')
<style>
.page-title {
    font-size: 1.5rem;
    border-left: 5px solid #FFBD38;
    padding-left: 1rem;
}
.form-check-input:checked {
    background-color: #FFBD38;
    border-color: #FFBD38;
}
.card-body h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #495057;
}
.form-control {
    font-size: 0.9rem;
}
</style>
@endpush
