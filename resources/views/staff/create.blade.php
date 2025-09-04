@extends('layouts.app')

@section('title', 'Tambah Staff')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Tambah Staff Baru</h1>

    <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary rounded-2">← Kembali</a>
            <button type="submit" class="btn btn-warning rounded-2">Simpan</button>
        </div>    
    </form>
</div>
@endsection
