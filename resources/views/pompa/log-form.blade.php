@extends('layouts.app')

@section('title', 'Log Harian Pompa')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Form Log Harian Pompa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pompa.logs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="pompa_unit_id" class="form-label">Jenis Pompa</label>
            <select name="pompa_unit_id" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                @foreach ($pompaUnits as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->nama_pompa }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="Baik">Baik</option>
                <option value="Perbaikan">Perbaikan</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Simpan Log</button>
    </form>
</div>
@endsection
