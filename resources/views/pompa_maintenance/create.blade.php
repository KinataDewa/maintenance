@extends('layouts.app')

@section('title', 'Perawatan Pompa')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Perawatan Pompa</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pompa.maintenance.store') }}" method="POST">
        @csrf

        <!-- Pilih Pompa -->
        <div class="mb-3">
            <label for="pompa_unit_id" class="form-label">Pilih Pompa</label>
            <select name="pompa_unit_id" id="pompa_unit_id" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                @foreach($pompas as $pompa)
                    <option value="{{ $pompa->id }}">{{ $pompa->nama_pompa ?? 'Pompa '.$pompa->id }}</option>
                @endforeach
            </select>
            @error('pompa_unit_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Info Pompa (akan muncul otomatis) -->
        <div id="info-pompa" class="mb-3" style="display: none;">
            <h6>Informasi Pompa:</h6>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> <span id="info-nama"></span></li>
                <li class="list-group-item"><strong>Merk:</strong> <span id="info-merk"></span></li>
                <li class="list-group-item"><strong>Tipe:</strong> <span id="info-tipe"></span></li>
                <li class="list-group-item"><strong>Kapasitas:</strong> <span id="info-kapasitas"></span></li>
            </ul>
        </div>

        <!-- Voltase -->
        <div class="mb-3">
            <label for="voltase" class="form-label">Voltase (V)</label>
            <input type="number" step="0.01" name="voltase" id="voltase" class="form-control">
            @error('voltase') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Suhu -->
        <div class="mb-3">
            <label for="suhu" class="form-label">Suhu (°C)</label>
            <input type="number" step="0.1" name="suhu" id="suhu" class="form-control">
            @error('suhu') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Tekanan -->
        <div class="mb-3">
            <label for="tekanan" class="form-label">Tekanan (bar)</label>
            <input type="number" step="0.01" name="tekanan" id="tekanan" class="form-control">
            @error('tekanan') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Oli -->
        <div class="mb-3">
            <label for="oli" class="form-label">Kondisi Oli</label>
            <select name="oli" id="oli" class="form-select">
                <option value="">-- Pilih --</option>
                <option value="tidak">Tidak Bocor</option>
                <option value="bocor">Bocor</option>
            </select>
            @error('oli') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <!-- Suara -->
        <div class="mb-3">
            <label for="suara" class="form-label">Suara Pompa</label>
            <select name="suara" id="suara" class="form-select">
                <option value="">-- Pilih --</option>
                <option value="halus">Halus</option>
                <option value="kasar">Kasar</option>
            </select>
            @error('suara') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>

{{-- Script menampilkan info pompa --}}
<script>
    const pompas = @json($pompas);

    document.getElementById('pompa_unit_id').addEventListener('change', function() {
        const selectedId = this.value;
        const infoDiv = document.getElementById('info-pompa');

        if(selectedId) {
            const pompa = pompas.find(p => p.id == selectedId);
            document.getElementById('info-nama').textContent = pompa.nama_pompa ?? '-';
            document.getElementById('info-merk').textContent = pompa.merk ?? '-';
            document.getElementById('info-tipe').textContent = pompa.tipe ?? '-';
            document.getElementById('info-kapasitas').textContent = pompa.kapasitas ?? '-';
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });
</script>
@endsection
