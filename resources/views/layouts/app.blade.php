<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
}

/* Sidebar */
.sidebar {
    height: 100vh;
    background-color: #fff;
    border-right: 1px solid #dee2e6;
    padding-top: 1rem;
    position: fixed;
    top: 0;
    left: -260px;
    width: 260px;
    z-index: 1050;
    transition: all 0.4s ease;
    box-shadow: 2px 0 12px rgba(0,0,0,0.05);
}
.sidebar.active { left:0; }

/* Sidebar Header */
.sidebar .sidebar-header {
    font-weight: 700;
    font-size: 1.25rem;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 1rem;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 2;
}

/* Menu Links */
.sidebar .nav-link {
    color: #212529 !important;
    font-weight: 500;
    padding: 0.65rem 1rem;
    border-radius: 8px;
    margin: 0.25rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    transition: all 0.3s ease;
}
.sidebar .nav-link i { transition: transform 0.3s ease; }

/* Hover soft */
.sidebar .nav-link:hover {
    background-color: #f8f9fa;
    color: #FFBD38 !important;
}
.sidebar .nav-link:hover i {
    transform: scale(1.15);
    color: #FFBD38;
}

/* Aktif lebih clean */
.sidebar .nav-link.fw-bold {
    background-color: transparent;
    color: #FFBD38 !important;
    border-left: 4px solid #FFBD38;
    font-weight: 600;
}

/* Matikan underline animasi */
.sidebar .nav-link::after { display: none; }

/* Overlay mobile */
.sidebar-overlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.3);
    z-index: 1040;
    display: none;
}
.sidebar-overlay.active { display:block; }

/* Content */
.content { margin-left:0; padding:0.5rem; transition: margin-left 0.4s ease; }
.page-title {
    font-weight:700;
    font-size:1.75rem;
    color:#343a40;
    margin-bottom:1.5rem;
    border-left:5px solid #FFBD38;
    padding-left:1rem;
    text-shadow:0 2px 4px rgba(0,0,0,0.05);
}

/* Navbar Mobile */
.navbar-mobile { display:none; }
@media (max-width:991.98px){
    .navbar-mobile { display:flex; align-items:center; padding:0.5rem 1rem; background:#fff; border-bottom:1px solid #dee2e6; position:sticky; top:0; z-index:1060;}
    .content { padding-top:0rem; }
    .sidebar .sidebar-header img { display:none; }
}

/* Desktop */
@media (min-width:992px){
    .sidebar { left:0; }
    .content { margin-left:260px; }
}

/* Tombol Tambah Daftar */
.tambahDaftar {
    font-family: 'Poppins', sans-serif;
    color: #212529;
    background-color: #fff;
    border: 1px solid #FFBD38;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 0.5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.3rem;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}
.tambahDaftar:hover {
    background-color: #FFBD38;
    color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

@stack('styles')
</head>
<body>

{{-- Navbar Mobile --}}
<div class="navbar-mobile d-lg-none d-flex align-items-center px-1 py-2">
    <button class="btn text-warning me-3" id="sidebarToggleMobile">
        <i class="bi bi-list fs-2"></i>
    </button>
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Maintenance" class="me-3" style="height:30px;">
    <span class="fw-bold fs-4">Maintenance</span>
</div>


{{-- Sidebar --}}
<div class="sidebar shadow-sm" id="sidebarMenu">
    <div class="sidebar-header d-flex align-items-center gap-2">
        <img src="{{ asset('images/logo2.png') }}" alt="Logo" height="25">
        <span>Maintenance</span>
    </div>

    <ul class="nav flex-column px-2">
        @auth
        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>

        @if(auth()->user()->role=='staff')
            {{-- Daily Staff --}}
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->is('checklist*','meteran*','induk*','pompa*','suhu*',) ? 'fw-bold' : '' }}" href="#daftarSubmenu" data-bs-toggle="collapse">
                    <span><i class="bi bi-list-check"></i> Daftar</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled ps-3 {{ request()->is('checklist*','meteran*','induk*','pompa*','suhu*',) ? 'show' : '' }}" id="daftarSubmenu">
                    @php
                    $dailyCards = [
                        ['title'=>'On/Off Perangkat','icon'=>'clipboard-check-fill','route'=>route('checklist.index')],
                        ['title'=>'Listrik Tenant','icon'=>'lightning-charge-fill','route'=>route('meteran.create')],
                        ['title'=>'Listrik Induk PLN','icon'=>'plug-fill','route'=>route('induk.create')],
                        ['title'=>'Pompa','icon'=>'droplet-fill','route'=>route('pompa.logs.create')],
                        ['title'=>'Suhu Ruangan','icon'=>'thermometer-half','route'=>route('temperature.create')],
                    ];
                    @endphp
                    @foreach($dailyCards as $card)
                    <li>
                        <a class="nav-link {{ request()->url()==$card['route'] ? 'fw-bold' : '' }}" href="{{ $card['route'] }}">
                            <i class="bi bi-{{ $card['icon'] }}"></i> {{ $card['title'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
        @elseif(auth()->user()->role=='admin')
            {{-- Daftar Admin --}}
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->is('perangkat*','tenants*','pompa*','rooms*','exhaustfan*', 'panel*') ? 'fw-bold' : '' }}" href="#daftarSubmenu" data-bs-toggle="collapse">
                    <span><i class="bi bi-list-check"></i> Daftar</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled ps-3 {{ request()->is('perangkat*','tenants*','pompa*','rooms*','exhaustfan*') ? 'show' : '' }}" id="daftarSubmenu">
                    @php
                    $daftarCards = [
                        ['title'=>'Daftar Perangkat','icon'=>'cpu','route'=>route('perangkat.index')],
                        ['title'=>'Daftar Tenant','icon'=>'building','route'=>route('tenants.index')],
                        ['title'=>'Daftar Pompa','icon'=>'water','route'=>route('pompa.index')],
                        ['title'=>'Daftar Ruangan','icon'=>'door-closed','route'=>route('rooms.index')],
                        ['title'=>'Daftar Exhaust Fan','icon'=>'fan','route'=>route('exhaustfan.index')],
                        ['title'=>'Daftar Panel','icon'=>'diagram-3','route'=>route('panel.index')],                        
                    ];
                    @endphp
                    @foreach($daftarCards as $card)
                    <li>
                        <a class="nav-link {{ request()->url()==$card['route'] ? 'fw-bold' : '' }}" href="{{ $card['route'] }}">
                            <i class="bi bi-{{ $card['icon'] }}"></i> {{ $card['title'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
        @endif

        <li class="nav-item"> <a class="nav-link {{ request()->is('riwayat') ? 'fw-bold' : '' }}" href="{{ route('riwayat.index') }}"> <i class="bi bi-clock-history"></i> Riwayat </a> </li>
        {{-- Logout/Profile --}}
        <hr class="my-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile') ? 'fw-bold' : '' }}" href="{{ route('profile.edit') }}">
                <i class="bi bi-person-lines-fill"></i> Profil
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </li>
        @endauth
    </ul>
</div>

{{-- Overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- Content --}}
<div class="content">
    <main>
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebar = document.getElementById('sidebarMenu');
const overlay = document.getElementById('sidebarOverlay');
const toggleMobile = document.getElementById('sidebarToggleMobile');

toggleMobile.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});
</script>
@stack('scripts')
@yield('scripts')
</body>
</html>
