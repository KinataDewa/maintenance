@extends('layouts.app')

@section('title', 'Input Perawatan Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title mb-4">Input Perawatan Exhaust Fan</h3>

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

    <form action="{{ route('perawatan-exhaust-fans.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        {{-- Pilih Exhaust Fan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Exhaust Fan</label>
            <select name="exhaust_fan_id" class="form-select" required>
                <option value="">-- Pilih Exhaust Fan --</option>
                @foreach($exhaustFans as $fan)
                    <option value="{{ $fan->id }}" {{ old('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                        {{ $fan->nama_fan ?? $fan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Input Daya Hisap dan Suhu --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="daya_hisap" class="form-label fw-semibold">Daya Hisap (CFM)</label>
                <input type="number" step="0.01" name="daya_hisap" id="daya_hisap" class="form-control" placeholder="Contoh: 150.50" value="{{ old('daya_hisap') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="suhu" class="form-label fw-semibold">Suhu (°C)</label>
                <input type="number" step="0.01" name="suhu" id="suhu" class="form-control" placeholder="Contoh: 28.5" value="{{ old('suhu') }}">
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Before" {{ old('status')=='Before' ? 'selected' : '' }}>Before</option>
                <option value="After" {{ old('status')=='After' ? 'selected' : '' }}>After</option>
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

        {{-- Perawatan (disembunyikan default, tampil jika status=After) --}}
        <div id="perawatanSection" class="{{ old('status') == 'After' ? '' : 'd-none' }}">
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
            <hr class="my-4">
        </div>

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

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save me-1"></i> Simpan Perawatan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Tampilkan/sembunyikan bagian Perawatan sesuai status
document.getElementById('status')?.addEventListener('change', function() {
    const perawatan = document.getElementById('perawatanSection');
    if (this.value === 'After') {
        perawatan.classList.remove('d-none');
        perawatan.classList.add('animate__animated', 'animate__fadeIn');
    } else {
        perawatan.classList.add('d-none');
    }
});

// Preview multiple images
document.getElementById('foto')?.addEventListener('change', function() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    const files = this.files;
    if (!files) return;
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
