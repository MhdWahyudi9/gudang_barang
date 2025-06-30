<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Routing Barang (tanpa show)
Route::resource('barang', BarangController::class)->except(['show']);

// Cetak barcode per barang
Route::get('barang/{id}/cetak-barcode', [BarangController::class, 'cetakBarcode'])->name('barang.cetak_barcode');

// Cetak semua barcode
Route::get('barang/cetak-semua-barcode', [BarangController::class, 'cetakSemuaBarcode'])->name('barang.cetak_semua_barcode');

// Barang Masuk
Route::get('barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
Route::get('barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
Route::post('barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
Route::get('barang-masuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang_masuk.edit');
Route::put('barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barang_masuk.update');
Route::delete('barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');
Route::get('laporan/barang-masuk', [BarangMasukController::class, 'laporan'])->name('barang_masuk.laporan');
Route::get('laporan/barang-masuk/export-pdf', [BarangMasukController::class, 'exportPdf'])->name('barang_masuk.export_pdf');

// Barang Keluar
Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar.index');
Route::get('barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang_keluar.create');
Route::post('barang-keluar', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
Route::get('barang-keluar/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barang_keluar.edit');
Route::put('barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barang_keluar.update');
Route::delete('barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang_keluar.destroy');
Route::get('laporan/barang-keluar', [BarangKeluarController::class, 'laporan'])->name('barang_keluar.laporan');
Route::get('laporan/barang-keluar/export-pdf', [BarangKeluarController::class, 'exportPdf'])->name('barang_keluar.export_pdf');



