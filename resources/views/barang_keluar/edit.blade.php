@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Barang Keluar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('barang_keluar.update', $barangKeluar->id_keluar) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="id_barang" class="form-control" required>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id_barang }}" {{ $barangKeluar->id_barang == $b->id_barang ? 'selected' : '' }}>
                                {{ $b->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $barangKeluar->jumlah }}" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $barangKeluar->tanggal }}" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $barangKeluar->keterangan }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Update
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
