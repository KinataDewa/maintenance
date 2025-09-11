@extends('layouts.app')

@section('title', 'Input Mesin STP')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Mesin STP</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('mesin-stp.store') }}" method="POST">
        @csrf

        <!-- Pilih Mesin -->
        <div class="mb-3">
            <label for="mesin" class="form-label">Pilih Mesin</label>
            <select name="mesin" id="mesin" class="form-select" required>
                <option value="">-- Pilih Mesin --</option>
                <option value="Mesin STP 1" {{ old('mesin') == 'Mesin STP 1' ? 'selected' : '' }}>Mesin STP 1</option>
                <option value="Mesin STP 2" {{ old('mesin') == 'Mesin STP 2' ? 'selected' : '' }}>Mesin STP 2</option>
            </select>
            @error('mesin') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Oli -->
        <div class="mb-3">
            <label for="oli" class="form-label">Kondisi Oli</label>
            <select name="oli" id="oli" class="form-select" required>
                <option value="">-- Pilih Kondisi Oli --</option>
                <option value="Baik" {{ old('oli') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Perlu Ditambah" {{ old('oli') == 'Perlu Ditambah' ? 'selected' : '' }}>Perlu Ditambah</option>
                <option value="Perlu Diganti" {{ old('oli') == 'Perlu Diganti' ? 'selected' : '' }}>Perlu Diganti</option>
            </select>
            @error('oli') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Vanbelt -->
        <div class="mb-3">
            <label for="vanbelt" class="form-label">Kondisi Vanbelt</label>
            <select name="vanbelt" id="vanbelt" class="form-select" required>
                <option value="">-- Pilih Kondisi Vanbelt --</option>
                <option value="Kencang" {{ old('vanbelt') == 'Kencang' ? 'selected' : '' }}>Kencang</option>
                <option value="Kendur" {{ old('vanbelt') == 'Kendur' ? 'selected' : '' }}>Kendur</option>
                <option value="Perlu Diganti" {{ old('vanbelt') == 'Perlu Diganti' ? 'selected' : '' }}>Perlu Diganti</option>
            </select>
            @error('vanbelt') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Suhu Mesin -->
        <div class="mb-3">
            <label for="suhu" class="form-label">Suhu (°C)</label>
            <input type="number" step="0.1" name="suhu" id="suhu" 
                   class="form-control" placeholder="Masukkan suhu mesin" value="{{ old('suhu') }}" required>
            @error('suhu') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Kondisi Suara -->
        <div class="mb-3">
            <label for="suara" class="form-label">Kondisi Suara</label>
            <select name="suara" id="suara" class="form-select" required>
                <option value="">-- Pilih Kondisi Suara --</option>
                <option value="Halus" {{ old('suara') == 'Halus' ? 'selected' : '' }}>Halus</option>
                <option value="Bising Ringan" {{ old('suara') == 'Bising Ringan' ? 'selected' : '' }}>Bising Ringan</option>
                <option value="Bising Berat" {{ old('suara') == 'Bising Berat' ? 'selected' : '' }}>Bising Berat</option>
            </select>
            @error('suara') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Catatan -->
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan jika diperlukan">{{ old('catatan') }}</textarea>
            @error('catatan') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
