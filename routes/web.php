<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistLogController;

// Halaman dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

// Halaman checklist
Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklists.update');

// Tombol Simpan Semua → simpan ke log + reset
Route::post('/checklists/log', [ChecklistLogController::class, 'store'])->name('checklists.log.store');

// Menampilkan riwayat log
Route::get('/checklists/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');

Route::delete('/checklists/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
Route::delete('/checklists/log/{id}', [ChecklistLogController::class, 'destroy'])->name('checklists.destroy');
