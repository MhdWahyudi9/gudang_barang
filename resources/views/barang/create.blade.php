@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Barang</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" value="{{ $kode_barang }}" readonly>
                    <input type="hidden" name="kode_barang" value="{{ $kode_barang }}">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
