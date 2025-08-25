@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Edit Staff</h1>

    <form action="{{ route('staff.update', $staff) }}" method="POST" enctype="multipart/form-data" id="staffForm">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control" value="{{ $staff->address }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label><br>
            @if($staff->photo)
                <img src="{{ asset('storage/'.$staff->photo) }}" width="100" class="mb-2 rounded shadow-sm">
            @endif
            <input type="file" name="photo" id="photoInput" class="form-control">
        </div>

        <!-- Crop & Preview -->
        <div class="mb-4 d-none" id="cropContainer">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Atur & Crop Foto</span>
                    <small class="text-muted">Geser & zoom sesuai kebutuhan</small>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="crop-wrapper border rounded">
                                <img id="cropImage" style="max-width:100%; display:block;">
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <p class="fw-semibold">Preview</p>
                            <div class="preview rounded-circle border mx-auto" 
                                style="width:150px; height:150px; overflow:hidden;">
                            </div>
                            <button type="button" id="cropBtn" class="btn btn-success w-100 mt-3">
                                <i class="bi bi-check-circle"></i> Gunakan Foto
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden input untuk hasil crop -->
        <input type="hidden" name="cropped_photo" id="croppedPhoto">

        <div class="mb-3">
            <label class="form-label">Password (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">
            <i class="bi bi-save"></i> Update
        </button>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
<style>
    .cropper-view-box,
    .cropper-face {
        border-radius: 50% !important; /* bulat */
    }
    .preview img {
        width: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper;
    const photoInput = document.getElementById('photoInput');
    const cropContainer = document.getElementById('cropContainer');
    const cropImage = document.getElementById('cropImage');
    const croppedPhoto = document.getElementById('croppedPhoto');
    const cropBtn = document.getElementById('cropBtn');

    photoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                cropImage.src = event.target.result;
                cropContainer.classList.remove('d-none');

                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1, // square
                    viewMode: 2,
                    preview: '.preview',
                    movable: true,
                    zoomable: true,
                    rotatable: false,
                    scalable: false,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropBtn.addEventListener('click', () => {
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });
        canvas.toBlob((blob) => {
            const reader = new FileReader();
            reader.onloadend = () => {
                croppedPhoto.value = reader.result; // base64 string
            };
            reader.readAsDataURL(blob);
        });
        alert('Foto berhasil dicrop, siap disimpan!');
    });
</script>
@endpush
