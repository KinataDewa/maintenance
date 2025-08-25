@extends('layouts.app')

@section('title', 'Input Suhu Ruangan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Suhu Ruangan</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('temperature.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="room_id" class="form-label">Pilih Ruangan</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="titik_1" class="form-label">Titik 1 (°C)</label>
            <input type="number" name="titik_1" class="form-control" step="0.1" required>
        </div>

        <div class="mb-3">
            <label for="titik_2" class="form-label">Titik 2 (°C)</label>
            <input type="number" name="titik_2" class="form-control" step="0.1" required>
        </div>

        <div class="mb-3">
            <label for="titik_3" class="form-label">Titik 3 (°C)</label>
            <input type="number" name="titik_3" class="form-control" step="0.1" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-warning btn-lg text-white shadow-sm">Simpan</button>
        </div>    
    </form>
</div>
@endsection
