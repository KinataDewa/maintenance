@extends('layouts.app')

@section('title', 'Input Meteran Induk PLN')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Input Meteran Induk PLN</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('meteran-induk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Kwh --}}
        <div class="mb-3">
            <label for="kwh" class="form-label">Kwh</label>
            <input type="text" name="kwh" id="kwh" class="form-control" required>
            @error('kwh') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_kwh" class="form-label mt-2">Foto Kwh</label>
            <input type="file" name="foto_kwh" id="foto_kwh" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_kwh" src="#" alt="Preview Foto Kwh" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        {{-- Cos φ --}}
        <div class="mb-3">
            <label for="cosphi" class="form-label">Cos φ</label>
            <input type="text" name="cosphi" id="cosphi" class="form-control" required>
            @error('cosphi') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_cosphi" class="form-label mt-2">Foto Cos φ</label>
            <input type="file" name="foto_cosphi" id="foto_cosphi" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_cosphi" src="#" alt="Preview Foto Cos φ" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        {{-- Kvar --}}
        <div class="mb-3">
            <label for="kvar" class="form-label">Kvar</label>
            <input type="text" name="kvar" id="kvar" class="form-control" required>
            @error('kvar') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_kvar" class="form-label mt-2">Foto Kvar</label>
            <input type="file" name="foto_kvar" id="foto_kvar" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_kvar" src="#" alt="Preview Foto Kvar" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        {{-- WBP --}}
        <div class="mb-3">
            <label for="wbp" class="form-label">WBP</label>
            <input type="text" name="wbp" id="wbp" class="form-control" required>
            @error('wbp') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_wbp" class="form-label mt-2">Foto WBP</label>
            <input type="file" name="foto_wbp" id="foto_wbp" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_wbp" src="#" alt="Preview Foto WBP" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        {{-- LWBp --}}
        <div class="mb-3">
            <label for="lwbp" class="form-label">LWBP</label>
            <input type="text" name="lwbp" id="lwbp" class="form-control" required>
            @error('lwbp') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_lwbp" class="form-label mt-2">Foto LWBP</label>
            <input type="file" name="foto_lwbp" id="foto_lwbp" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_lwbp" src="#" alt="Preview Foto LWBP" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        {{-- Total --}}
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" name="total" id="total" class="form-control" required>
            @error('total') <div class="text-danger small">{{ $message }}</div> @enderror

            <label for="foto_total" class="form-label mt-2">Foto Total</label>
            <input type="file" name="foto_total" id="foto_total" class="form-control" accept="image/*" capture="environment" required>
            <img id="preview_total" src="#" alt="Preview Foto Total" class="img-fluid rounded mt-2" style="display:none; max-height: 300px;">
        </div>

        <button type="submit" class="btn btn-warning text-white">Simpan</button>
    </form>
</div>

<script>
    function setupPreview(idInput, idPreview) {
        document.getElementById(idInput).addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById(idPreview);

            if (file && file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    }

    ['kwh', 'cosphi', 'kvar', 'wbp', 'lwbp', 'total'].forEach(field => {
        setupPreview('foto_' + field, 'preview_' + field);
    });
</script>
@endsection
