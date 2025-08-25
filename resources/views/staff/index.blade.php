@extends('layouts.app')

@section('title', 'Daftar Staff')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Staff</h3>

    <a href="{{ route('staff.create') }}" class="tambahDaftar mb-3">
        + Tambah Staff
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($staffs as $staff)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        {{-- Foto --}}
                        @if($staff->photo)
                            <img src="{{ asset('storage/'.$staff->photo) }}" alt="Foto" 
                                 class="rounded-circle mb-3" width="80" height="80" 
                                 style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-3"
                                 style="width:80px; height:80px;">
                                <i class="bi bi-person text-white fs-2"></i>
                            </div>
                        @endif

                        {{-- Nama & Email --}}
                        <h5 class="card-title mb-1">{{ $staff->name }}</h5>
                        <p class="text-muted mb-2">{{ $staff->email }}</p>

                        {{-- Kontak --}}
                        <p class="small mb-1"><i class="bi bi-telephone me-1"></i> {{ $staff->phone ?? '-' }}</p>
                        <p class="small text-muted"><i class="bi bi-geo-alt me-1"></i> {{ $staff->address ?? '-' }}</p>

                        {{-- Aksi --}}
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('staff.edit', $staff) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('staff.destroy', $staff) }}" method="POST" 
                                  onsubmit="return confirm('Hapus staff ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada staff yang terdaftar.</p>
        @endforelse
    </div>
</div>
@endsection
