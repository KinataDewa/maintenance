@extends('layouts.app')

@section('title', 'Riwayat Meteran Listrik')

@section('content')
<div class="container">
    <h1 class="mb-4">Riwayat Meteran Listrik</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada data meteran listrik yang tercatat.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($riwayat as $data)
                <div class="col">
                    <div class="card h-100 shadow-sm border border-warning">
                        <div class="card-body">
                            <h5 class="card-title text-warning">
                                <i class="bi bi-lightning-charge-fill me-2"></i>{{ $data->tenant->nama }}
                            </h5>
                            <p class="mb-1">
                                <strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($data->waktu_input)->translatedFormat('d F Y') }}
                            </p>
                            <p class="mb-1">
                                <strong>Jam:</strong>
                                {{ \Carbon\Carbon::parse($data->waktu_input)->format('H:i') }}
                            </p>
                            <p class="mb-1"><strong>Kwh:</strong> {{ $data->kwh }}</p>
                            <p class="mb-1"><strong>Deskripsi:</strong> {{ $data->deskripsi ?? '-' }}</p>
                        </div>
                        @if($data->foto && file_exists(public_path('storage/' . $data->foto)))
                        <img src="{{ asset('storage/' . $data->foto) }}" class="card-img-bottom" alt="Foto Meteran" style="object-fit: cover; height: 200px;">
                        @else
                            <div class="text-center p-3">
                                <i class="bi bi-image text-secondary" style="font-size: 48px;"></i><br>
                                <small class="text-muted">Foto tidak tersedia</small>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
