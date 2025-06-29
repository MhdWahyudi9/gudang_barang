<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Routing Barang
Route::resource('barang', BarangController::class);

// Cetak barcode per barang
Route::get('barang/{id}/cetak-barcode', [BarangController::class, 'cetakBarcode'])->name('barang.cetak_barcode');

// Cetak semua barcode (opsional)
Route::get('barang/cetak-semua-barcode', [BarangController::class, 'cetakSemuaBarcode'])->name('barang.cetak_semua_barcode');

// Barang Masuk
Route::get('barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
Route::get('barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
Route::post('barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');

// Barang Keluar
Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar.index');
Route::get('barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang_keluar.create');
Route::post('barang-keluar', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
