@extends('layouts.app')

@section('title', 'Riwayat Perubahan Pengaduan')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <h3 class="page-title mb-4 fw-bold">Riwayat Perubahan Pengaduan</h3>

    @if($histories->isEmpty())
        <div class="alert alert-info rounded-4">Belum ada riwayat perubahan untuk pengaduan ini.</div>
    @else
        @foreach($histories as $i => $h)
            <div class="card p-3 mb-3 shadow-sm rounded-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="fw-semibold">#{{ $i + 1 }} | Pengaduan:</span>
                    <small class="text-muted">{{ $h->created_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="mb-1"><strong>Jenis Kendala:</strong> {{ $h->pengaduan->jenis_kendala ?? '-' }}</div>
                <div class="mb-1"><strong>Status:</strong> {{ $h->status_lama }} → {{ $h->status_baru }}</div>
                <div class="mb-1"><strong>Progres:</strong> {{ $h->progres_lama ?? '-' }} → {{ $h->progres_baru ?? '-' }}</div>
                <div><strong>Diubah Oleh:</strong> {{ $h->editor->name ?? 'Unknown' }}</div>
            </div>
        @endforeach
    @endif

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('pengaduan.riwayat') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>
@endsection
