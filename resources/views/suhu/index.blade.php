@extends('layouts.app')

@section('content')
<div class="container my-4" style="font-family: 'Poppins', sans-serif; max-width: 600px;">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title">Cek Suhu Ruangan</h1>        <!-- Tanggal & Jam Otomatis -->
        {{-- <div class="text-end">
            <div id="tanggal" class="fw-semibold"></div>
            <div id="jam" class="text-success fw-bold"></div>
        </div> --}}
    </div>

    <!-- Form Cek Suhu -->
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body">
            <!-- Dropdown Lokasi -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi (Lantai)</label>
                <select class="form-select rounded-3">
                    <option value="" selected disabled>Pilih Lantai</option>
                    <option value="Ground">Ground</option>
                    <option value="Lantai 1">Lantai 1</option>
                    <option value="Lantai 2">Lantai 2</option>
                    <option value="Lantai 3">Lantai 3</option>
                    <option value="Lantai 4">Lantai 4</option>
                    <option value="Lantai 5">Lantai 5</option>
                    <option value="Lantai 6">Lantai 6</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Shift / Jam</label>
                <select name="shift" class="form-select rounded-3" required>
                    <option value="" selected disabled>Pilih Shift</option>
                    <option value="10:00">Shift Pagi (10:00)</option>
                    <option value="14:00">Shift Siang (14:00)</option>
                </select>
            </div>

            <!-- Input Suhu -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Suhu (°C)</label>
                <input type="number" step="0.1" class="form-control rounded-3" placeholder="Masukkan suhu">
            </div>

            <!-- Input Kelembapan -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Kelembapan (%)</label>
                <input type="number" step="0.1" class="form-control rounded-3" placeholder="Masukkan kelembapan">
            </div>

            <!-- Catatan Opsional -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Catatan <small class="text-muted">(Opsional)</small></label>
                <textarea name="catatan" class="form-control rounded-3" rows="2" placeholder="Tulis catatan tambahan jika diperlukan"></textarea>
            </div>
            
            <!-- Tombol Simpan -->
            <button class="btn w-100 rounded-3 fw-semibold text-white" style="background-color: #dc3545;">
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- Script Tanggal & Jam Otomatis -->
<script>
    function updateTime() {
        const now = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' });
        const [tanggal, waktu] = now.split(' ');
        document.getElementById('tanggal').textContent = tanggal;
        document.getElementById('jam').textContent = waktu;
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection
