@extends('layouts.app')

@section('content')
<div class="container my-4" style="font-family: 'Poppins', sans-serif;">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-water me-2 text-info"></i> Checklist STP
            </h3>
            <small class="text-muted">Lakukan pengecekan semua bagian STP setiap hari.</small>
        </div>
    </div>

    <!-- Accordion STP -->
    <div class="accordion mb-5" id="accordionSTP">

        <!-- Great Chamber -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#gc">
                    <i class="bi bi-droplet-half me-2 text-primary"></i> Great Chamber
                </button>
            </h2>
            <div id="gc" class="accordion-collapse collapse show">
                <div class="accordion-body bg-light">
                    @foreach(['Membersihkan great chamber'] as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Keterangan (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Aeration Tank -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#aeration">
                    <i class="bi bi-cloud-drizzle me-2 text-info"></i> Aeration Tank
                </button>
            </h2>
            <div id="aeration" class="accordion-collapse collapse">
                <div class="accordion-body bg-light">
                    @foreach([
                        'Pengangkatan sampah padat',
                        'Periksa kerataan air Seal Deffuser',
                        'Atur dan stel gate valve air Seal Deffuser',
                        'Bersihkan sampah yang mengapung',
                        'Periksa warna air bak aerasi'
                    ] as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Keterangan (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sedimentation Tank -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sedimentation">
                    <i class="bi bi-water me-2 text-warning"></i> Sedimentation Tank
                </button>
            </h2>
            <div id="sedimentation" class="accordion-collapse collapse">
                <div class="accordion-body bg-light">
                    @foreach([
                        'Periksa kerja air Lift Pump dan Scum Scimmer',
                        'Bersihkan sampah yang mengapung',
                        'Periksa kejernihan air'
                    ] as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Keterangan (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Effluen Tank -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#effluen">
                    <i class="bi bi-speedometer2 me-2 text-danger"></i> Effluen Tank
                </button>
            </h2>
            <div id="effluen" class="accordion-collapse collapse">
                <div class="accordion-body bg-light">
                    @foreach([
                        'Periksa fungsi pelampung',
                        'Pengecekan PH (6-9)',
                        'Flow Meter'
                    ] as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Keterangan (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Ruang STP -->
        <div class="accordion-item border-0 mb-5 shadow-sm rounded-3 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ruangstp">
                    <i class="bi bi-gear-wide-connected me-2 text-purple" style="color:#6f42c1;"></i> Ruang STP
                </button>
            </h2>
            <div id="ruangstp" class="accordion-collapse collapse">
                <div class="accordion-body bg-light">
                    @foreach([
                        'Periksa mesin kerja blower',
                        'Periksa dan isi Chemial Chlorin',
                        'Pembersihan mesin blower STP',
                        'Kontrol Panel Control',
                        'Ganti Oli dan tambah grease mesin blower'
                    ] as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Keterangan (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- Tombol Simpan Semua -->
    <div class="fixed-bottom p-3 bg-white border-top">
        <button class="btn w-100 rounded-3 fw-semibold text-white py-2" style="background-color:#fd7e14;">
            <i class="bi bi-save me-1"></i> Simpan Semua
        </button>
    </div>
</div>

<!-- Script highlight status -->
<script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            if (this.value === 'Tidak Baik') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
</script>
@endsection
