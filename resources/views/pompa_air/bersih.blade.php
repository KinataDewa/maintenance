@extends('layouts.app')

@section('title', 'Pompa Air Bersih')

@section('content')
<div class="container py-4">
<h1 class="page-title">Form Pompa Air Bersih</h1>

    {{-- Informasi Alat --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Alat</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nama Alat:</strong> Pompa Air Bersih</li>
                <li class="list-group-item"><strong>Type:</strong> SG 13252A</li>
                <li class="list-group-item"><strong>Kapasitas Motor:</strong> 7,5 HP</li>
            </ul>
        </div>
    </div>

    {{-- Form Isian --}}
    <form>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 5%;">No</th>
                        <th>Pekerjaan</th>
                        <th>Keterangan</th>
                        <th style="width: 20%;">Nama / Paraf</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td>
                            <input type="date" class="form-control" name="tanggal_{{ $i }}" value="{{ date('Y-m-d') }}">
                        </td>
                        <td>{{ $i }}</td>
                        <td>
                            <input type="text" class="form-control" name="pekerjaan_{{ $i }}" placeholder="Isi pekerjaan">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="keterangan_{{ $i }}" placeholder="Isi keterangan">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="paraf_{{ $i }}" placeholder="Nama/Paraf">
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3" disabled>Simpan</button>
        </div>
    </form>
</div>
@endsection
