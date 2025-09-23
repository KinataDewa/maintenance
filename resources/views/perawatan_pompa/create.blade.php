@extends('layouts.app')

@section('title', 'Input Perawatan Pompa')

@section('content')
<div class="container py-4">
    <h3 class="page-title mb-4">Input Perawatan Pompa</h3>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert error --}}
    @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <div class="fw-bold mb-1">Terjadi kesalahan:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perawatan-pompa.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        {{-- Pilih Pompa --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Pompa</label>
            <select name="pompa_unit_id" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                @foreach($pompas as $pompa)
                    <option value="{{ $pompa->id }}" {{ old('pompa_unit_id') == $pompa->id ? 'selected' : '' }}>
                        {{ $pompa->nama_pompa }} - {{ $pompa->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Before">Before</option>
                <option value="After">After</option>
            </select>
        </div>

        <hr class="my-4">

        {{-- Pengecekan --}}
        <h5 class="fw-bold mb-3">Pengecekan</h5>
        @foreach($pengecekanItems as $kategori => $checks)
            <div class="mb-3">
                <strong>{{ $kategori }}</strong>
                @foreach($checks as $check)
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="pengecekan[{{ $kategori }}][]" 
                               id="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}" 
                               value="{{ $check }}"
                               {{ isset(old('pengecekan')[$kategori]) && in_array($check, old('pengecekan')[$kategori]) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check) }}">
                            {{ $check }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <hr class="my-4">

        {{-- Perawatan --}}
        <h5 class="fw-bold mb-3">Perawatan</h5>
        @foreach($perawatanItems as $kategori => $checks)
            <div class="mb-3">
                <strong>{{ $kategori }}</strong>
                @foreach($checks as $check)
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="perawatan[{{ $kategori }}][]" 
                               id="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check.'-perawatan') }}" 
                               value="{{ $check }}"
                               {{ isset(old('perawatan')[$kategori]) && in_array($check, old('perawatan')[$kategori]) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($kategori.'-'.$check.'-perawatan') }}">
                            {{ $check }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- Foto --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Foto (Opsional)</label>
            <input type="file" name="foto[]" id="foto" class="form-control" multiple accept="image/*">
            <div class="mt-2" id="previewContainer"></div>
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Catatan (Opsional)</label>
            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save me-1"></i> Simpan Perawatan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Preview multiple images
document.getElementById('foto')?.addEventListener('change', function() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    const files = this.files;
    if(!files) return;
    Array.from(files).forEach(file => {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.classList.add('img-fluid', 'rounded', 'me-2', 'mb-2');
        img.style.maxHeight = '120px';
        container.appendChild(img);
    });
});
</script>
@endpush
@endsection
