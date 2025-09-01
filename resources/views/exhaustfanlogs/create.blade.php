@extends('layouts.app')

@section('title', 'Input Log Exhaust Fan')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Log Exhaust Fan</h3>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <div class="fw-bold mb-1">Terjadi kesalahan:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('exhaustfanlogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilih Exhaust Fan --}}
        <div class="mb-3">
            <label for="exhaust_fan_id" class="form-label">Pilih Exhaust Fan</label>
            <select name="exhaust_fan_id" id="exhaust_fan_id" class="form-select" required>
                <option value="">-- Pilih Exhaust Fan --</option>
                @foreach ($exhaustFans as $fan)
                    <option value="{{ $fan->id }}" {{ old('exhaust_fan_id') == $fan->id ? 'selected' : '' }}>
                        {{ $fan->nama }} - {{ $fan->ruangan }} - {{ $fan->merk }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Checklist Perawatan --}}
        <div class="mb-3">
            <label class="form-label">Checklist Perawatan</label>
            @php
                $options = ['Pembersihan', 'Pemeriksaan', 'Penggantian Filter', 'Pelumasan', 'Lainnya'];
                $oldPerawatan = old('perawatan', []);
                if (!is_array($oldPerawatan)) {
                    $oldPerawatan = explode(',', $oldPerawatan);
                }
            @endphp

            @foreach ($options as $option)
                <div class="form-check">
                    <input 
                        class="form-check-input"
                        type="checkbox"
                        name="perawatan[]"
                        id="perawatan_{{ \Illuminate\Support\Str::slug($option) }}"
                        value="{{ $option }}"
                        {{ in_array($option, $oldPerawatan) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perawatan_{{ \Illuminate\Support\Str::slug($option) }}">
                        {{ $option }}
                    </label>
                </div>
            @endforeach
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
        </div>

        {{-- Foto Before --}}
        <div class="mb-3">
            <label for="foto_before" class="form-label">Foto Before (Sebelum)</label>
            <input type="file" name="foto_before" id="foto_before" class="form-control" accept="image/*">
            <div class="mt-2">
                <img id="preview_before" src="#" alt="" class="img-fluid rounded d-none" style="max-height:160px;">
            </div>
        </div>

        {{-- Foto After --}}
        <div class="mb-3">
            <label for="foto_after" class="form-label">Foto After (Sesudah)</label>
            <input type="file" name="foto_after" id="foto_after" class="form-control" accept="image/*">
            <div class="mt-2">
                <img id="preview_after" src="#" alt="" class="img-fluid rounded d-none" style="max-height:160px;">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>      
    </form>
</div>

@push('scripts')
<script>
function preview(input, previewId){
    const file = input.files && input.files[0];
    if(!file) return;
    const img = document.getElementById(previewId);
    img.src = URL.createObjectURL(file);
    img.classList.remove('d-none');
}
document.getElementById('foto_before')?.addEventListener('change', function(){ preview(this, 'preview_before'); });
document.getElementById('foto_after')?.addEventListener('change', function(){ preview(this, 'preview_after'); });
</script>
@endpush
@endsection
