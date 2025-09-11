@extends('layouts.app')

@section('title', 'Input Pompa STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Pompa STP</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('pompa-stp.store') }}" method="POST">
        @csrf

        <!-- Pilih Pompa -->
        <div class="mb-3">
            <label for="pompa" class="form-label">Pilih Pompa</label>
            <select name="pompa" id="pompa" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                <option value="Pompa STP 1" {{ old('pompa') == 'Pompa STP 1' ? 'selected' : '' }}>Pompa STP 1</option>
                <option value="Pompa STP 2" {{ old('pompa') == 'Pompa STP 2' ? 'selected' : '' }}>Pompa STP 2</option>
            </select>
            @error('pompa') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Voltase -->
        <div class="mb-3">
            <label for="voltase" class="form-label">Voltase (V)</label>
            <input type="number" step="0.01" name="voltase" id="voltase" 
                   class="form-control" value="{{ old('voltase') }}" placeholder="Masukkan voltase" required>
            @error('voltase') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Suhu -->
        <div class="mb-3">
            <label for="suhu" class="form-label">Suhu (°C)</label>
            <input type="number" step="0.1" name="suhu" id="suhu" 
                   class="form-control" value="{{ old('suhu') }}" placeholder="Masukkan suhu" required>
            @error('suhu') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Oli -->
        <div class="mb-3">
            <label for="oli" class="form-label">Kondisi Oli</label>
            <select name="oli" id="oli" class="form-select" required>
                <option value="">-- Pilih Kondisi Oli --</option>
                <option value="Normal" {{ old('oli') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Kurang" {{ old('oli') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                <option value="Kotor" {{ old('oli') == 'Kotor' ? 'selected' : '' }}>Kotor</option>
            </select>
            @error('oli') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Pulling -->
        <div class="mb-3">
            <label for="pulling" class="form-label">Kondisi Pulling</label>
            <select name="pulling" id="pulling" class="form-select" required>
                <option value="">-- Pilih Kondisi Pulling --</option>
                <option value="Baik" {{ old('pulling') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Perlu Dicek" {{ old('pulling') == 'Perlu Dicek' ? 'selected' : '' }}>Perlu Dicek</option>
                <option value="Rusak" {{ old('pulling') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
            @error('pulling') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Motor -->
        <div class="mb-3">
            <label for="motor" class="form-label">Kondisi Motor</label>
            <select name="motor" id="motor" class="form-select" required>
                <option value="">-- Pilih Kondisi Motor --</option>
                <option value="Normal" {{ old('motor') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Overheat" {{ old('motor') == 'Overheat' ? 'selected' : '' }}>Overheat</option>
                <option value="Bergetar" {{ old('motor') == 'Bergetar' ? 'selected' : '' }}>Bergetar</option>
                <option value="Tidak Berfungsi" {{ old('motor') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
            </select>
            @error('motor') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Catatan (Opsional) -->
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan jika diperlukan">{{ old('catatan') }}</textarea>
            @error('catatan') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
