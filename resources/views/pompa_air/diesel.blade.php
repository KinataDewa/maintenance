@extends('layouts.app')

@section('title', 'Diesel Pump')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4" style="font-family: 'Poppins', sans-serif;">Form Diesel Pump</h1>

    {{-- Informasi Alat --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Informasi Alat</h5>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item"><strong>Merk:</strong> ISUZU</li>
                <li class="list-group-item"><strong>Kapasitas Motor:</strong> 2500 RPM</li>
            </ul>
        </div>
    </div>

    {{-- Form Input --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Pompa</label>
                    <select class="form-select" id="status">
                        <option selected disabled>Pilih Status</option>
                        <option>Berfungsi</option>
                        <option>Tidak Berfungsi</option>
                        <option>Dalam Perbaikan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tekanan" class="form-label">Tekanan (bar)</label>
                    <input type="number" step="0.1" class="form-control" id="tekanan" placeholder="Contoh: 3.5">
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Tambahan</label>
                    <textarea class="form-control" id="catatan" rows="3" placeholder="Isi jika ada..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" id="foto" accept="image/*">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning fw-semibold px-4">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
