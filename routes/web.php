<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');

// Update status checklist
Route::put('/checklist/{id}/status', [ChecklistController::class, 'updateStatus'])->name('checklists.update-status');

// Update staff checklist
Route::put('/checklist/{id}/staff', [ChecklistController::class, 'updateStaff'])->name('checklists.update-staff');