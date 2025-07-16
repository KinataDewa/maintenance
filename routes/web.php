<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistLogController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklists.update');
Route::post('/checklist/save-all', [ChecklistLogController::class, 'store'])->name('checklists.save-all');
Route::get('/checklist/riwayat', [ChecklistLogController::class, 'riwayat'])->name('checklists.riwayat');

// // Update status checklist
// Route::put('/checklist/{id}/status', [ChecklistController::class, 'updateStatus'])->name('checklists.update-status');

// // Update staff checklist
// Route::put('/checklist/{id}/staff', [ChecklistController::class, 'updateStaff'])->name('checklists.update-staff');