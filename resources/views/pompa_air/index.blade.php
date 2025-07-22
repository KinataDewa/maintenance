@extends('layouts.app')

@section('title', 'Pompa Air')

@section('content')
<div class="container py-4">
    <h1 class="page-title">Form Pompa Air</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('pompa-air.bersih') }}" class="text-decoration-none">
                <div class="card shadow-sm border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-droplet text-primary fs-1 mb-2"></i>
                        <h5 class="card-title mb-0">Pompa Air Bersih</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('pompa-air.diesel') }}" class="text-decoration-none">
                <div class="card shadow-sm border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-fuel-pump text-warning fs-1 mb-2"></i>
                        <h5 class="card-title mb-0">Diesel Pump</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('pompa-air.hydrant') }}" class="text-decoration-none">
                <div class="card shadow-sm border-danger">
                    <div class="card-body text-center">
                        <i class="bi bi-fire text-danger fs-1 mb-2"></i>
                        <h5 class="card-title mb-0">Pompa Hydrant</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
