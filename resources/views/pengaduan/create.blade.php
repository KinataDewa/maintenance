@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')
<div class="container py-4">
    <h3 class="page-title mb-4 fw-bold">Form Pengaduan</h3>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        {{-- Jenis Perangkat --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Perangkat</label>
            <select class="form-select" name="perangkat_tipe" id="perangkat_tipe" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="AC">AC</option>
                <option value="ExhaustFan">Exhaust Fan</option>
                <option value="Panel">Panel</option>
                <option value="Perangkat">Perangkat</option>
                <option value="PompaUnit">Pompa Unit</option>
                <option value="Perbaikan">Perbaikan Umum</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            @error('perangkat_tipe') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Input Perangkat Lainnya --}}
        <div class="mb-3 d-none" id="lainnyaField">
            <label class="form-label fw-semibold">Perangkat Lainnya</label>
            <input type="text" name="perangkat_lainnya" class="form-control" placeholder="Masukkan nama perangkat lainnya">
        </div>

        {{-- Ruangan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Ruangan / Lokasi</label>
            <select name="room_id" class="form-select" id="room_id" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->nama ?? $room->name }}</option>
                @endforeach
                <option value="lainnya">Lainnya</option>
            </select>
            @error('room_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Input Lokasi Lainnya --}}
        <div class="mb-3 d-none" id="lokasiLainnyaField">
            <label class="form-label fw-semibold">Lokasi Lainnya</label>
            <input type="text" name="lokasi_lainnya" class="form-control" placeholder="Masukkan lokasi lainnya">
            @error('lokasi_lainnya') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Jenis Kendala --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Kendala / Keluhan</label>
            <input type="text" name="jenis_kendala" class="form-control" placeholder="Contoh: AC tidak dingin di ruang rapat" value="{{ old('jenis_kendala') }}" required>
            @error('jenis_kendala') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi / Penjelasan Lengkap</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan kondisi kerusakan atau kendala">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- PIC --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama PIC Ruangan</label>
                <input type="text" name="pic_nama" class="form-control" placeholder="Nama penanggung jawab" value="{{ old('pic_nama') }}" required>
                @error('pic_nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nomor Telepon PIC</label>
                <input type="text" name="pic_telp" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('pic_telp') }}" required>
                @error('pic_telp') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Foto --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Foto Pendukung (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark fw-semibold px-4">
                <i class="bi bi-send me-1"></i> Kirim Pengaduan
            </button>
        </div>
    </form>
</div>

{{-- Script: tampilkan field Lainnya --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const perangkatSelect = document.getElementById('perangkat_tipe');
    const perangkatLainnya = document.getElementById('lainnyaField');
    const roomSelect = document.getElementById('room_id');
    const lokasiLainnya = document.getElementById('lokasiLainnyaField');

    perangkatSelect.addEventListener('change', function() {
        if (this.value === 'Lainnya') {
            perangkatLainnya.classList.remove('d-none');
        } else {
            perangkatLainnya.classList.add('d-none');
        }
    });

    roomSelect.addEventListener('change', function() {
        if (this.value === 'lainnya') {
            lokasiLainnya.classList.remove('d-none');
        } else {
            lokasiLainnya.classList.add('d-none');
        }
    });
});
</script>
@endsection
