@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <h3 class="mb-4 fw-bold">Edit Pengaduan #{{ $pengaduan->id }}</h3>

    @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" class="card p-4 shadow-sm rounded-4">
        @csrf
        @method('PUT')

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select" required>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" {{ $pengaduan->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Progres --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Progres</label>
            <input type="text" name="progres" class="form-control" 
                   value="{{ old('progres', $pengaduan->progres) }}" 
                   placeholder="Tuliskan progres atau catatan pengerjaan">
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('pengaduan.riwayat') }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary fw-semibold">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
