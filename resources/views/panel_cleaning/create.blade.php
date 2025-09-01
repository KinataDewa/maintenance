@extends('layouts.app')

@section('title', 'Input Cleaning Panel')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Input Cleaning Panel</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('panel-cleaning.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Pilih Panel --}}
        <div class="mb-3">
            <label for="panel_id" class="form-label">Pilih Panel</label>
            <select name="panel_id" id="panel_id" class="form-select" required>
                <option value="">-- Pilih Panel --</option>
                @foreach ($panels as $p)
                    @php
                        $nama = $p->nama ?? $p->name ?? 'Tanpa Nama';
                        $lokasi = $p->lokasi ?? $p->location ?? '-';
                    @endphp
                    <option value="{{ $p->id }}">{{ $nama }} - {{ $lokasi }}</option>
                @endforeach
            </select>
        </div>

        {{-- Checklist --}}
        <div class="mb-3">
            <label class="form-label">Checklist Pembersihan</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="debu_bersih" id="debu_bersih" value="1">
                <label class="form-check-label" for="debu_bersih">Debu sudah dibersihkan</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="luar_bersih" id="luar_bersih" value="1">
                <label class="form-check-label" for="luar_bersih">Bagian luar panel bersih</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="dalam_rapi" id="dalam_rapi" value="1">
                <label class="form-check-label" for="dalam_rapi">Bagian dalam panel rapi</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tidak_ada_sampah" id="tidak_ada_sampah" value="1">
                <label class="form-check-label" for="tidak_ada_sampah">Tidak ada sampah/serpihan tersisa</label>
            </div>
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
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
