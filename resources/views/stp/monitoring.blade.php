@extends('layouts.app')

@section('content')
<div class="container my-4" style="font-family: 'Poppins', sans-serif;">
    <h1 class="page-title mb-4 fw-bold">STP Monitoring</h1>

    <!-- Accordion STP -->
    <div class="accordion" id="accordionSTP">

        @php
            $stpSections = [
                'Great Chamber' => ['Membersihkan great chamber'],
                'Aeration Tank' => [
                    'Pengangkatan sampah padat',
                    'Periksa kerataan air Seal Deffuser',
                    'Atur dan stel gate valve air Seal Deffuser',
                    'Bersihkan sampah yang mengapung',
                    'Periksa warna air bak aerasi'
                ],
                'Sedimentation Tank' => [
                    'Periksa kerja air Lift Pump dan Scum Scimmer',
                    'Bersihkan sampah yang mengapung',
                    'Periksa kejernihan air'
                ],
                'Effluen Tank' => [
                    'Periksa fungsi pelampung',
                    'Pengecekan PH (6-9)',
                    'Flow Meter'
                ],
                'Ruang STP' => [
                    'Periksa mesin kerja blower',
                    'Periksa dan isi Chemial Chlorin',
                    'Pembersihan mesin blower STP',
                    'Kontrol Panel Control',
                    'Ganti Oli dan tambah grease mesin blower'
                ]
            ];
            $icons = [
                'Great Chamber' => 'droplet-half text-primary',
                'Aeration Tank' => 'cloud-drizzle text-info',
                'Sedimentation Tank' => 'water text-warning',
                'Effluen Tank' => 'speedometer2 text-danger',
                'Ruang STP' => 'gear-wide-connected text-purple'
            ];
        @endphp

        @foreach($stpSections as $section => $activities)
        <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button fw-semibold @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#section{{ $loop->index }}">
                    <i class="bi bi-{{ $icons[$section] }} me-2"></i> {{ $section }}
                </button>
            </h2>
            <div id="section{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif">
                <div class="accordion-body bg-light">
                    @foreach($activities as $aktivitas)
                        <div class="card mb-3 border-0 shadow-sm rounded-3 hover-shadow" style="transition: 0.3s;">
                            <div class="card-body">
                                <label class="fw-semibold d-block mb-2">{{ $aktivitas }}</label>
                                <div class="row g-2">
                                    <div class="col-md-4 col-12 mb-2 mb-md-0">
                                        <select class="form-select status-select">
                                            <option>Baik</option>
                                            <option>Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="keterangan{{ $loop->parent->index }}{{ $loop->index }}" placeholder="Keterangan opsional">
                                            <label for="keterangan{{ $loop->parent->index }}{{ $loop->index }}">Keterangan (opsional)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Tombol Simpan -->
    <div class="mt-3 text-end">
        <button type="submit" class="btn btn-warning btn-sm text-white shadow-sm px-4">
            <i class="bi bi-save me-1"></i> Simpan
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

<style>
    /* Hover effect untuk card */
    .hover-shadow:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        transform: translateY(-2px);
    }

    /* Accordion lebih elegan */
    .accordion-button {
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        color: #343a40;
        font-size: 1rem;
        transition: 0.3s;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #212529;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }

    .accordion-button i {
        font-size: 1.25rem;
    }

    /* Page title */
    .page-title {
        font-size: 1.8rem;
        color: #343a40;
    }

    /* Floating button hover */
    .btn-gradient:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }

    /* Responsive spacing */
    @media (max-width: 768px) {
        .accordion-button {
            font-size: 0.95rem;
        }
    }
</style>
@endsection