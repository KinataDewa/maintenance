@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Profil Saya</h1>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profil berhasil diperbarui.</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label><br>
            @if(auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" 
                     class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
            @endif
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-warning">Simpan</button>
    </form>
</div>
@endsection
