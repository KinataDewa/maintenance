@extends('layouts.app')

@section('title', 'Profil Saya')

@push('styles')
<style>
    /* Card Profil Modern */
    .profile-card {
        max-width: 480px;
        margin: 2rem auto;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 2rem 1.5rem;
        background: #fff;
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #222;
    }

    .profile-card img.profile-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #FFC107;
        margin-bottom: 1rem;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-card h4 {
        font-weight: 600;
        margin-bottom: 0.3rem;
        font-size: 1.35rem;
    }

    .profile-card p {
        margin-bottom: 0.35rem;
        font-size: 0.95rem;
        color: #555;
    }

    .profile-card .btn-edit,
    .profile-card .btn-logout {
        margin-top: 1rem;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
    }

    .profile-card .btn-logout {
        border: 1px solid #dc3545;
        color: #dc3545;
        background: #fff;
    }

    .profile-card .btn-logout:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Modal */
    .modal-content {
        border-radius: 10px;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .profile-card {
            padding: 1.5rem 1rem;
        }
        .profile-card h4 {
            font-size: 1.2rem;
        }
        .profile-card p {
            font-size: 0.9rem;
        }
        .profile-card img.profile-photo {
            width: 100px;
            height: 100px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <h1 class="page-title">Profil Saya</h1>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success text-center">Profil berhasil diperbarui.</div>
    @endif

    <div class="profile-card card">
        @if(auth()->user()->photo)
            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="profile-photo" alt="Foto Profil">
        @else
            <div class="rounded-circle bg-secondary mb-3" style="width:120px; height:120px; display:inline-block; margin:auto;"></div>
        @endif

        <h4>{{ auth()->user()->name }}</h4>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>HP:</strong> {{ auth()->user()->phone ?? '-' }}</p>
        <p class="mb-0"><strong>Alamat:</strong> {{ auth()->user()->address ?? '-' }}</p>

        <div class="d-flex justify-content-center gap-2 mt-3">
            {{-- Tombol Edit Profil --}}
            <button type="button" class="btn btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square"></i> Edit Profil
            </button>

            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
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

                    <div class="mb-3 text-center">
                        <label class="form-label d-block">Foto Profil</label>
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" 
                                 class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
                        @endif
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Jika ada error validasi, buka modal otomatis
    @if ($errors->any())
        var editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        editModal.show();
    @endif
</script>
@endpush
