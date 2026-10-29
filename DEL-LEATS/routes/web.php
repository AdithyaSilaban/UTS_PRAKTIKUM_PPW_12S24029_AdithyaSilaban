<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Equipment routes
|--------------------------------------------------------------------------
*/

// Katalog perangkat laboratorium (dengan pagination, pencarian & filter)
Route::get('equipments', [EquipmentController::class, 'index'])->name('equipments.index');

// Formulir tambah aset perangkat
Route::get('equipments/create', [EquipmentController::class, 'create'])->name('equipments.create');

// Simpan aset perangkat baru
Route::post('equipments', [EquipmentController::class, 'store'])->name('equipments.store');

// Detail spesifikasi & ketersediaan aset
Route::get('equipments/{id}', [EquipmentController::class, 'show'])->name('equipments.show');

/*
|--------------------------------------------------------------------------
| Loan routes
|--------------------------------------------------------------------------
*/

// Riwayat peminjaman
Route::get('loans', [LoanController::class, 'index'])->name('loans.index');

// Formulir pengajuan peminjaman aset
Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');

// Validasi aturan bisnis & transaksi peminjaman
Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
