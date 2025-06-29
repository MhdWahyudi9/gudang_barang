@extends('layouts.app')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Barang Keluar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('barang_keluar.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="id_barang" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
