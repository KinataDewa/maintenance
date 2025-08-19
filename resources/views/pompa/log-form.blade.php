@extends('layouts.app')

@section('title', 'Log Harian Pompa')
@push('styles')
@push('styles')
<style>
    /* Card detail pompa minimalis & profesional */
    #pompa-details.card {
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 1.2rem 1.5rem;
        max-width: 500px;
        margin: 2rem auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #222;
    }

    #pompa-details .card-title {
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #ddd;
        padding-bottom: 0.3rem;
        color: #111;
        text-align: center;
    }

    .pompa-detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pompa-detail-list li {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
        font-size: 1rem;
    }

    .pompa-detail-list li:last-child {
        border-bottom: none;
    }

    .pompa-detail-label {
        font-weight: 500;
        color: #555;
        user-select: none;
    }

    .pompa-detail-value {
        font-weight: 600;
        color: #000;
    }

    /* Responsive */
    @media (max-width: 480px) {
        #pompa-details.card {
            max-width: 100%;
            padding: 1rem;
        }
        .pompa-detail-list li {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.2rem;
        }
        .pompa-detail-value {
            font-size: 1.1rem;
        }
    }
</style>
@endpush


@section('content')
<div class="container py-4">
    <h3 class="page-title">Form Log Harian Pompa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pompa.logs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="pompa_unit_id" class="form-label">Jenis Pompa</label>
            <select name="pompa_unit_id" id="pompa_unit_id" class="form-select" required>
                <option value="">-- Pilih Pompa --</option>
                @foreach ($pompaUnits as $unit)
                    <option value="{{ $unit->id }}"
                        data-merk="{{ $unit->merk }}"
                        data-tipe="{{ $unit->tipe }}"
                        data-kapasitas="{{ $unit->kapasitas }}"
                        data-tekanan="{{ $unit->tekanan }}">
                        {{ $unit->nama_pompa }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Detail Pompa -->
        <div id="pompa-details" class="card" style="display: none;">
            <h5 class="card-title">Detail Pompa</h5>
            <ul class="pompa-detail-list">
                <li>
                    <span class="pompa-detail-label">Merk</span>
                    <span id="merk" class="pompa-detail-value">-</span>
                </li>
                <li>
                    <span class="pompa-detail-label">Tipe</span>
                    <span id="tipe" class="pompa-detail-value">-</span>
                </li>
                <li>
                    <span class="pompa-detail-label">Kapasitas</span>
                    <span id="kapasitas" class="pompa-detail-value">-</span>
                </li>
                <li>
                    <span class="pompa-detail-label">Tekanan</span>
                    <span id="tekanan" class="pompa-detail-value">-</span>
                </li>
            </ul>
        </div>
        <div class="mb-3">
            <label for="meteran" class="form-label">Meteran</label>
            <input type="text" name="meteran" id="meteran" class="form-control" placeholder="Masukkan nilai meteran">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan keterangan tambahan..."></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Simpan</button>
    </form>
</div>

<script>
document.getElementById('pompa_unit_id').addEventListener('change', function() {
    let selected = this.options[this.selectedIndex];
    if (this.value) {
        document.getElementById('merk').textContent = selected.getAttribute('data-merk') || '-';
        document.getElementById('tipe').textContent = selected.getAttribute('data-tipe') || '-';
        document.getElementById('kapasitas').textContent = selected.getAttribute('data-kapasitas') || '-';
        document.getElementById('tekanan').textContent = selected.getAttribute('data-tekanan') || '-';
        document.getElementById('pompa-details').style.display = 'block';
    } else {
        document.getElementById('pompa-details').style.display = 'none';
    }
});
</script>
@endsection


