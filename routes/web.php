<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistLogController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\MeteranListrikController;
use App\Http\Controllers\MeteranIndukController;
use App\Http\Controllers\PompaLogController;
use App\Http\Controllers\PompaUnitController;
use App\Http\Controllers\SuhuRuanganController;
use App\Http\Controllers\StpController;

// Halaman landing bebas login (opsional)
Route::get('/', function () {
    return redirect()->route('login');
});

// Arahkan ke dashboard setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Semua fitur hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

    // Checklist
    // Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
    // Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklists.update');
    // Route::post('/checklists/log', [ChecklistLogController::class, 'store'])->name('checklists.log.store');
    // Route::delete('/checklists/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
    // Route::delete('/checklists/log/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
    // Route::get('/checklists/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');

    Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
    Route::post('/checklist/store', [ChecklistController::class, 'store'])->name('checklist.store');
    Route::get('/checklist/riwayat', [ChecklistController::class, 'riwayat'])->name('checklist.riwayat');

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

    // ✅ CRUD untuk master jenis pompa (tanpa show)
    Route::resource('pompa', PompaUnitController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);

    // ✅ Input log pompa harian dan riwayat
    Route::prefix('pompa')->name('pompa.')->group(function () {
        Route::get('form', [PompaLogController::class, 'create'])->name('logs.create');         // Ubah dari 'log' ke 'form'
        Route::post('form', [PompaLogController::class, 'store'])->name('logs.store');          // Ubah dari 'log' ke 'form'
        Route::get('riwayat', [PompaLogController::class, 'history'])->name('logs.history');
    });


    // Suhu Ruangan
    Route::get('/suhu-ruangan', [SuhuRuanganController::class, 'index'])->name('suhu.index');

    // STP
    Route::get('/stp', [StpController::class, 'index'])->name('stp.index');
    Route::post('/stp', [StpController::class, 'store'])->name('stp.store');
});

require __DIR__.'/auth.php';
