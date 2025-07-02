<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Route awal: redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (hanya login & logout)
Route::middleware('guest')->group(function () {
    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Semua route setelah login
Route::middleware(['auth'])->group(function () {
    // Setelah login langsung ke barang.index
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('barang', BarangController::class)->except(['show']);
    
    Route::get('barang/{id}/cetak-barcode', [BarangController::class, 'cetakBarcode'])->name('barang.cetak_barcode');
    Route::get('barang/cetak-semua-barcode', [BarangController::class, 'cetakSemuaBarcode'])->name('barang.cetak_semua_barcode');

    Route::get('barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
    Route::get('barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
    Route::post('barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::get('barang-masuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang_masuk.edit');
    Route::put('barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barang_masuk.update');
    Route::delete('barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');
    Route::get('barang-masuk/export-pdf', [BarangMasukController::class, 'exportPdf'])->name('barang_masuk.export_pdf');

    Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar.index');
    Route::get('barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang_keluar.create');
    Route::post('barang-keluar', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
    Route::get('barang-keluar/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barang_keluar.edit');
    Route::put('barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barang_keluar.update');
    Route::delete('barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang_keluar.destroy');
    Route::get('barang-keluar/export-pdf', [BarangKeluarController::class, 'exportPdf'])->name('barang_keluar.export_pdf');
});
