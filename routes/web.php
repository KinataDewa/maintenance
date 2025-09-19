<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistLogController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\MeteranListrikController;
use App\Http\Controllers\MeteranIndukController;
use App\Http\Controllers\PompaLogController;
use App\Http\Controllers\PompaUnitController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTemperatureLogController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ExhaustFanController;
use App\Http\Controllers\ExhaustFanLogController;
use App\Http\Controllers\PanelCleaningController;
use App\Http\Controllers\StpController;
use App\Http\Controllers\PemakaianAirController;
use App\Http\Controllers\PompaMaintenanceController;
use App\Http\Controllers\PanelInspectionController;
use App\Http\Controllers\PompaStpController;
use App\Http\Controllers\PerawatanPanelController;

    // Halaman landing bebas login (opsional)
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // dashboard setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    // Semua fitur hanya bisa diakses setelah login
    Route::middleware(['auth'])->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    // Profile
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // Dashboard Staff
    Route::get('/dashboard-staff/form-harian', [DashboardStaffController::class, 'formHarian'])->name('dashboard.staff.formharian');
    Route::get('/dashboard-staff/pengecekan', [DashboardStaffController::class, 'pengecekan'])->name('dashboard.staff.pengecekan');
    Route::get('/dashboard-staff/perawatan', [DashboardStaffController::class, 'perawatan'])->name('dashboard.staff.perawatan');
    Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
    Route::post('/checklist/store', [ChecklistController::class, 'store'])->name('checklist.store');
    Route::get('/checklist/riwayat', [ChecklistController::class, 'riwayat'])->name('checklist.riwayat');
    Route::get('/checklist/riwayat', [ChecklistController::class, 'riwayat'])->name('checklist.riwayat');

    // Staff Management (Admin Only)
    Route::middleware(['auth', 'admin'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('/create', [StaffController::class, 'create'])->name('create');
    Route::post('/', [StaffController::class, 'store'])->name('store');
    Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('edit');
    Route::put('/{staff}', [StaffController::class, 'update'])->name('update');
    Route::delete('/{staff}', [StaffController::class, 'destroy'])->name('destroy');
});

    //Perangkat 
    Route::resource('perangkat', PerangkatController::class);

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/checklist', [RiwayatController::class, 'checklist'])->name('riwayat.checklist');
    Route::get('/riwayat/meteran', [RiwayatController::class, 'meteran'])->name('riwayat.meteran');

    // Meteran Listrik Tenant
    Route::get('/meteran-listrik/create', [MeteranListrikController::class, 'create'])->name('meteran.create');
    Route::post('/meteran-listrik', [MeteranListrikController::class, 'store'])->name('meteran.store');
    Route::get('/meteran/riwayat', [MeteranListrikController::class, 'riwayat'])->name('meteran.riwayat');
    Route::get('/meteran/export', [MeteranListrikController::class, 'export'])->name('meteran.export');

    // Meteran Induk PLN
    Route::get('/meteran-induk/create', [MeteranIndukController::class, 'create'])->name('induk.create');
    Route::post('/meteran-induk', [MeteranIndukController::class, 'store'])->name('meteran-induk.store');
    Route::get('/meteran-induk/riwayat', [MeteranIndukController::class, 'riwayat'])->name('meteran-induk.riwayat');
    Route::get('/induk/export', [MeteranIndukController::class, 'export'])->name('meteran-induk.export');

    // Pompa Unit
Route::middleware('auth')->group(function () {

    // Pompa Unit CRUD
    Route::resource('pompa', PompaUnitController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);

    // Pompa Maintenance
    Route::get('pompa/maintenance/create', [PompaMaintenanceController::class, 'create'])->name('pompa.maintenance.create');
    Route::post('pompa/maintenance', [PompaMaintenanceController::class, 'store'])->name('pompa.maintenance.store');
    Route::get('pompa/maintenance/riwayat', [PompaMaintenanceController::class, 'riwayat'])->name('pompa.maintenance.riwayat');
});

    // Export Excel
    Route::get('logs/export', [PompaLogController::class, 'exportExcel'])->name('logs.export');
});


    // Route untuk log suhu ruangan
    Route::get('/room-temperature', [\App\Http\Controllers\RoomTemperatureLogController::class, 'create'])->name('temperature.create');
    Route::post('/room-temperature', [\App\Http\Controllers\RoomTemperatureLogController::class, 'store'])->name('temperature.store');

    // Riwayat suhu ruangan
    Route::get('/temperature/riwayat', [RoomTemperatureLogController::class, 'riwayat'])
    ->name('room-temperature-logs.riwayat');

    // Tenant
    Route::resource('tenants', TenantController::class);
    Route::get('/tenants/create', [\App\Http\Controllers\TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [\App\Http\Controllers\TenantController::class, 'store'])->name('tenants.store');
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');

    // Exhaust Fan
    Route::resource('exhaustfan', ExhaustFanController::class)->middleware('auth'); 

    // Exhaust Fan Log
    Route::middleware(['auth'])->group(function () {
    Route::get('/exhaustfanlogs/create', [ExhaustFanLogController::class, 'create'])->name('exhaustfanlogs.create');
    Route::post('/exhaustfanlogs', [ExhaustFanLogController::class, 'store'])->name('exhaustfanlogs.store');});
    Route::get('/exhaustfanlogs/riwayat', [ExhaustFanLogController::class, 'riwayat'])->name('exhaustfanlogs.riwayat');

    // Panel 
    Route::middleware(['auth'])->group(function () {
    Route::resource('panel', \App\Http\Controllers\PanelController::class);});
    
    // Cleaning Panel
    Route::prefix('panel-cleaning')->name('panel-cleaning.')->group(function () {
    Route::get('/create', [PanelCleaningController::class, 'create'])->name('create');
    Route::post('/', [PanelCleaningController::class, 'store'])->name('store');
    Route::get('/riwayat', [PanelCleaningController::class, 'riwayat'])->name('riwayat');});

    // STP
    Route::prefix('stp')->name('stp.')->group(function () {
        Route::get('/', [StpController::class, 'index'])->name('index');

        // Meteran
        Route::get('/meteran', [StpController::class, 'meteran'])->name('meteran');
        Route::post('/meteran', [StpController::class, 'storeMeteran'])->name('meteran.store'); 

        // Perawatan
        Route::get('/perawatan', [StpController::class, 'perawatan'])->name('perawatan');
        Route::post('/perawatan', [StpController::class, 'storePerawatan'])->name('perawatan.store'); 

        // Monitoring
        Route::get('/monitoring', [StpController::class, 'monitoring'])->name('monitoring');
    });

    Route::prefix('pemakaian-air')->name('pemakaian-air.')->middleware('auth')->group(function () {
    Route::get('/create', [PemakaianAirController::class, 'create'])->name('create');
    Route::post('/', [PemakaianAirController::class, 'store'])->name('store');
    Route::get('/riwayat', [PemakaianAirController::class, 'riwayat'])->name('riwayat');
    });

    Route::prefix('panel-inspections')->name('panel-inspections.')->group(function () {
        Route::get('/create', [PanelInspectionController::class, 'create'])->name('create');
        Route::post('/', [PanelInspectionController::class, 'store'])->name('store');
        Route::get('/riwayat', [PanelInspectionController::class, 'riwayat'])->name('riwayat');
    });

// Pompa STP
Route::prefix('pompa-stp')->name('pompa-stp.')->middleware('auth')->group(function () {
    Route::get('/create', [\App\Http\Controllers\PompaStpController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\PompaStpController::class, 'store'])->name('store');
    Route::get('/riwayat', [\App\Http\Controllers\PompaStpController::class, 'riwayat'])->name('riwayat');
});

// Mesin STP
Route::prefix('mesin-stp')->name('mesin-stp.')->middleware('auth')->group(function () {
    Route::get('/create', [\App\Http\Controllers\MesinStpController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\MesinStpController::class, 'store'])->name('store');
    Route::get('/riwayat', [\App\Http\Controllers\MesinStpController::class, 'riwayat'])->name('riwayat');
});


Route::prefix('perawatan-panels')->name('perawatan-panels.')->group(function () {
    Route::get('/create', [PerawatanPanelController::class, 'create'])->name('create');
    Route::post('/store', [PerawatanPanelController::class, 'store'])->name('store');
    Route::get('/riwayat', [PerawatanPanelController::class, 'riwayat'])->name('riwayat');
});

require __DIR__.'/auth.php';
