<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Maintenance App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-custom {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }
        .navbar-brand {
            font-weight: 700;
            color: #000 !important;
        }
        .nav-link {
            color: #000 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover,
        .nav-link.fw-bold {
            color: #FFBD38 !important;
        }
        .btn-warning {
            background-color: #FFBD38;
            border: none;
            color: #000;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Maintenance App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'fw-bold' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('checklist') ? 'fw-bold' : '' }}" href="{{ route('checklist.index') }}">
                            <i class="bi bi-list-check me-1"></i> Checklist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('riwayat') ? 'fw-bold' : '' }}" href="{{ route('riwayat.index') }}">
                            <i class="bi bi-clock-history me-1"></i> Riwayat
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @stack('scripts')
    @yield('scripts')

</body>
</html>