<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistLogController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\MeteranListrikController;
use App\Http\Controllers\PompaAirController;
use App\Http\Controllers\SuhuRuanganController;
use App\Http\Controllers\StpController;

// Halaman dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/riwayat', function () {
    return view('riwayat.index');
})->name('riwayat.index');

// Riwayat
Route::get('/checklists/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');

// Halaman checklist
Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklists.update');

// Tombol Simpan Semua → simpan ke log + reset
Route::post('/checklists/log', [ChecklistLogController::class, 'store'])->name('checklists.log.store');

// Menampilkan riwayat log
Route::get('/checklists/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');
Route::delete('/checklists/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
Route::delete('/checklists/log/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/checklist', [App\Http\Controllers\RiwayatController::class, 'checklist'])->name('riwayat.checklist');
Route::get('/riwayat/meteran', [App\Http\Controllers\RiwayatController::class, 'meteran'])->name('riwayat.meteran');
Route::get('/checklists/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');

// Meteran Listrik
Route::get('/meteran-listrik/create', [MeteranListrikController::class, 'create'])->name('meteran.create');
Route::post('/meteran-listrik', [MeteranListrikController::class, 'store'])->name('meteran.store');
Route::get('/meteran/riwayat', [MeteranListrikController::class, 'riwayat'])->name('meteran.riwayat');
Route::get('/meteran/export', [MeteranListrikController::class, 'export'])->name('meteran.export');

// Pompa Air
Route::get('/pompa-air', [PompaAirController::class, 'index'])->name('pompa-air.index');
Route::get('/pompa-air/bersih', [PompaAirController::class, 'bersih'])->name('pompa-air.bersih');
Route::get('/pompa-air/diesel', [PompaAirController::class, 'diesel'])->name('pompa-air.diesel');
Route::get('/pompa-air/hydrant', [PompaAirController::class, 'hydrant'])->name('pompa-air.hydrant');

// Suhu Ruangan
Route::get('/suhu-ruangan', [SuhuRuanganController::class, 'index'])->name('suhu.index');

// Stp
Route::get('/stp', [StpController::class, 'index'])->name('stp.index');
Route::post('/stp', [StpController::class, 'store'])->name('stp.store');