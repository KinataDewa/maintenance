@extends('layouts.app')

@section('title', 'Input Perbaikan')

@section('content')
<div class="container py-4">
    <h3 class="page-title mb-4">Input Perbaikan</h3>

    @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perbaikan.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nomor Pengaduan</label>
             <input type="number" name="np"class="form-control"value="{{ old('np') }}"placeholder="Masukkan NP"required>
            </div>

        <div class="mb-3">
            <label class="form-label">Jenis Perangkat</label>
            <select class="form-select" name="jenis_perangkat" id="jenis_perangkat" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="ac">AC</option>
                <option value="exhaust_fan">Exhaust Fan</option>
                <option value="panel">Panel</option>
                <option value="perangkat">Perangkat</option>
                <option value="pompa">Pompa</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Perangkat</label>
            {{-- select menyimpan perangkat_id (id dari tabel terkait) --}}
            <select class="form-select" name="perangkat_id" id="perangkat_select" required>
                <option value="">-- Pilih Jenis Perangkat Dulu --</option>
            </select>

            {{-- hidden menyimpan nama perangkat (teks) supaya server juga punya nama langsung --}}
            <input type="hidden" name="nama_perangkat" id="nama_perangkat_input" value="">
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kerusakan</label>
            <input class="form-control" name="jenis_kerusakan" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Kerusakan</label>
            <textarea class="form-control" name="deskripsi" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tindakan Perbaikan (opsional)</label>
            <textarea class="form-control" name="tindakan_perbaikan" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan (opsional)</label>
            <textarea class="form-control" name="catatan" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kondisi (Opsional)</label>
            <input type="file" class="form-control" name="foto" accept="image/*">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
        
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // dataset: array of {id, nama} for each jenis perangkat
    const datasets = {
        ac: @json($acs->map(function($a){ return ['id' => $a->id, 'nama' => $a->nama]; })),
        exhaust_fan: @json($exhaustFans->map(function($e){ return ['id' => $e->id, 'nama' => $e->nama]; })),
        panel: @json($panels->map(function($p){ return ['id' => $p->id, 'nama' => $p->nama]; })),
        perangkat: @json($perangkats->map(function($r){ return ['id' => $r->id, 'nama' => $r->nama]; })),
        pompa: @json($pompas->map(function($p){ return ['id' => $p->id, 'nama' => $p->nama]; })),
    };

    const jenisSelect = document.getElementById('jenis_perangkat');
    const perangkatSelect = document.getElementById('perangkat_select');
    const namaInput = document.getElementById('nama_perangkat_input');

    function fillPerangkatOptions(key) {
        perangkatSelect.innerHTML = '';
        const fallback = document.createElement('option');
        fallback.value = '';
        fallback.textContent = '-- Pilih Nama --';
        perangkatSelect.appendChild(fallback);

        if (!key || !datasets[key] || datasets[key].length === 0) {
            const opt = document.createElement('option');
            opt.value = '';
            opt.textContent = '-- Tidak ada data --';
            perangkatSelect.appendChild(opt);
            namaInput.value = '';
            return;
        }

        datasets[key].forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.id;
            opt.textContent = item.nama;
            perangkatSelect.appendChild(opt);
        });

        // reset nama hidden
        namaInput.value = '';
    }

    jenisSelect.addEventListener('change', function() {
        fillPerangkatOptions(this.value);
    });

    // update nama_perangkat hidden field setiap kali user pilih nama perangkat
    perangkatSelect.addEventListener('change', function() {
        const sel = this.options[this.selectedIndex];
        namaInput.value = sel && sel.value ? sel.text : '';
    });

    // jika di-load sudah ada nilai jenis (mis. form kembali setelah error), isi options
    if (jenisSelect.value) {
        fillPerangkatOptions(jenisSelect.value);
    }
});
</script>
@endsection
