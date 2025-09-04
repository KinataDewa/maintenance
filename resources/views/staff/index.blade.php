@extends('layouts.app')

@section('title', 'Daftar Staff')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-people me-2"></i> Daftar Staff
        </h3>
        <a href="{{ route('staff.create') }}" class="btn btn-dark rounded-3 shadow-sm px-3">
            <i class="bi bi-plus-lg"></i> Tambah Staff
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Daftar Staff --}}
    <div class="row g-4">
        @forelse($staffs as $staff)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 staff-card">
                    <div class="card-body text-center p-4">

                        {{-- Foto --}}
                        @if($staff->photo)
                            <img src="{{ asset('storage/'.$staff->photo) }}" alt="Foto" 
                                 class="rounded-circle shadow mb-3 border border-3 border-light"
                                 width="90" height="90" style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center shadow mb-3"
                                 style="width:90px; height:90px; background: linear-gradient(135deg, #343a40, #212529);">
                                <i class="bi bi-person text-white fs-2"></i>
                            </div>
                        @endif

                        {{-- Nama & Email --}}
                        <h5 class="card-title mb-1 fw-semibold text-dark">{{ $staff->name }}</h5>
                        <p class="text-muted mb-2">{{ $staff->email }}</p>

                        {{-- Kontak --}}
                        <div class="small text-start mt-3">
                            <p class="mb-1"><i class="bi bi-telephone me-1 text-secondary"></i> {{ $staff->phone ?? '-' }}</p>
                            <p class="mb-0"><i class="bi bi-geo-alt me-1 text-secondary"></i> {{ $staff->address ?? '-' }}</p>
                        </div>

                        {{-- Aksi --}}
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <a href="{{ route('staff.edit', $staff) }}" class="btn btn-sm btn-outline-warning px-3">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('staff.destroy', $staff) }}" method="POST" 
                                  onsubmit="return confirm('Hapus staff ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-3">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-light border shadow-sm">
                    <i class="bi bi-info-circle"></i> Belum ada staff yang terdaftar.
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .staff-card {
        transition: all 0.3s ease-in-out;
        border-radius: 16px;
    }
    .staff-card:hover {
        /* transform: translateY(-5px); */
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endsection
