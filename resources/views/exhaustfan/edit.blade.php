@extends('layouts.app')

@section('title', 'Edit Exhaust Fan')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Exhaust Fan</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('exhaustfan.update', $fan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Exhaust Fan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $fan->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <input type="text" name="ruangan" id="ruangan" class="form-control" value="{{ old('ruangan', $fan->ruangan) }}" required>
        </div>
        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" name="merk" id="merk" class="form-control" value="{{ old('merk', $fan->merk) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('exhaustfan.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection
