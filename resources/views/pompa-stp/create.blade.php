@extends('layouts.app')

@section('title', 'Input Pengecekan Pompa STP')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container py-4">
    <h3 class="fw-bold mb-4">Input Pengecekan Pompa STP</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pompa-stp.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Pompa</label>
            <select name="pompa" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                <option value="Pompa STP 1">Pompa STP 1</option>
                <option value="Pompa STP 2">Pompa STP 2</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Voltase (V)</label>
            <input type="number" name="voltase" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Suhu (°C)</label>
            <input type="number" name="suhu" class="form-control" step="0.1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Oli</label>
            <select name="oli" class="form-select" required>
                <option value="">-- Pilih Kondisi Oli --</option>
                <option value="Normal">Normal</option>
                <option value="Kurang">Kurang</option>
                <option value="Kotor">Kotor</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pulling</label>
            <select name="pulling" class="form-select" required>
                <option value="">-- Pilih Kondisi Pulling --</option>
                <option value="Baik">Baik</option>
                <option value="Perlu Dicek">Perlu Dicek</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Motor</label>
            <select name="motor" class="form-select" required>
                <option value="">-- Pilih Kondisi Motor --</option>
                <option value="Normal">Normal</option>
                <option value="Overheat">Overheat</option>
                <option value="Bergetar">Bergetar</option>
                <option value="Tidak Berfungsi">Tidak Berfungsi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
