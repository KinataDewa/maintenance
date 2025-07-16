@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h4 mb-4">Dashboard Staff Maintenance</h1>

    <div class="row g-4">
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Checklist Harian</h5>
                    <p class="card-text text-muted">Isi laporan kerja untuk hari ini.</p>
                    <a href="{{ route('checklist.index') }}" class="btn btn-warning">Mulai Checklist</a>
                </div>
            </div>
        </div>
    </div>
@endsection
