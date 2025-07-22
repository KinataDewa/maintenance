@extends('layouts.app')

@section('title', 'Pompa Air')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4" style="font-family: 'Poppins', sans-serif;">Form Pompa Air</h1>

    {{-- Dropdown Pilihan Jenis Pompa --}}
    <div class="mb-4">
        <label for="jenis_pompa" class="form-label fw-semibold">Pilih Jenis Pompa</label>
        <select id="jenis_pompa" class="form-select" onchange="updateInformasiAlat()" required>
            <option selected disabled>-- Pilih Jenis Pompa --</option>
            <option value="bersih">Pompa Air Bersih</option>
            <option value="diesel">Diesel Pump</option>
            <option value="hydrant">Pompa Hydrant</option>
        </select>
    </div>

    {{-- Informasi Alat --}}
    <div id="info-alat" class="card border-0 shadow-sm mb-4 d-none">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Informasi Alat</h5>
            <ul class="list-group list-group-flush small" id="alat-info-list">
                {{-- Akan diisi lewat JS --}}
            </ul>
        </div>
    </div>

    {{-- Form Input --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Pompa</label>
                    <select class="form-select" id="status" required>
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

{{-- Script Informasi Alat --}}
<script>
    function updateInformasiAlat() {
        const jenis = document.getElementById('jenis_pompa').value;
        const infoCard = document.getElementById('info-alat');
        const infoList = document.getElementById('alat-info-list');
        infoCard.classList.remove('d-none');

        let data = {};

        switch (jenis) {
            case 'bersih':
                data = {
                    'Type': 'SG13252A',
                    'Kapasitas ': '7.5 HP'
                };
                break;
            case 'diesel':
                data = {
                    'Merk': 'ISUZU',
                    'Kapasitas ': '2500 RPM'
                };
                break;
            case 'hydrant':
                data = {
                    'Type': 'SG225M2',
                    'Tekanan ': '60 HP'
                };
                break;
        }

        infoList.innerHTML = '';
        for (const [key, value] of Object.entries(data)) {
            infoList.innerHTML += `<li class="list-group-item"><strong>${key}:</strong> ${value}</li>`;
        }
    }
</script>
@endsection
