@extends('layouts.app')

@section('title', 'Daftar Tenant')

@section('content')
<div class="container py-4">
    <h3 class="page-title">Daftar Tenant</h3>

    @if (session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tenants.create') }}" class="btn btn-warning mb-3 rounded-3">+ Tambah Tenant</a>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Tenant</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tenants as $tenant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tenant->nama }}</td>
                    <td>{{ $tenant->lantaiTenant ?? '-' }}</td>
                    <td>{{ $tenant->ruanganTenant ?? '-' }}</td>
                    <td>
                        <div class="d-grid d-md-flex justify-content-center gap-2">
                            <a href="{{ route('tenants.edit', $tenant->id) }}" 
                                class="btn btn-outline-primary rounded-2 text-center"
                                style="min-width: 120px; width: 120px; height: 38px;">
                                Edit
                            </a>

                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus tenant ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger rounded-2 text-center"
                                        style="min-width: 120px; width: 120px; height: 38px;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada tenant</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
