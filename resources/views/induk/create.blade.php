@extends('layouts.app')

@section('title', 'Input Meteran Induk PLN')

@section('content')
<div class="container py-4">
    <h1 class="page-title mb-4">Input Meteran Induk PLN</h1>

    @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('meteran-induk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @php
            $fields = [
                ['name'=>'kwh', 'label'=>'Kwh'],
                ['name'=>'cosphi', 'label'=>'Cos φ'],
                ['name'=>'kvar', 'label'=>'Kvar'],
                ['name'=>'wbp', 'label'=>'WBP'],
                ['name'=>'lwbp', 'label'=>'LWBP'],
                ['name'=>'total', 'label'=>'Total'],
            ];
        @endphp

        <div class="row g-4">
            @foreach($fields as $field)
            <div class="col-md-6">
                <div class="card shadow-sm p-3 h-100">
                    <div class="mb-3">
                        <label for="{{ $field['name'] }}" class="form-label fw-bold">{{ $field['label'] }}</label>
                        <input type="text" name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control form-control-lg" required>
                        @error($field['name']) 
                            <div class="text-danger small">{{ $message }}</div> 
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto_{{ $field['name'] }}" class="form-label fw-bold">Foto {{ $field['label'] }}</label>
                        <input type="file" name="foto_{{ $field['name'] }}" id="foto_{{ $field['name'] }}" class="form-control" accept="image/*" capture="environment" required>
                        <div class="text-center mt-2">
                            <img id="preview_{{ $field['name'] }}" src="#" alt="Preview Foto {{ $field['label'] }}" class="img-fluid rounded shadow-sm" style="display:none; max-height: 250px; border: 1px solid #ddd; padding: 3px;">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-warning btn-lg text-white shadow-sm">Simpan</button>
        </div>
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
