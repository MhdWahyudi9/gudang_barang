@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Laporan Barang Masuk</h3>
    <a href="{{ route('barang_masuk.export_pdf', request()->all()) }}" class="btn btn-danger mb-3">
        <i class="fas fa-file-pdf"></i> Export PDF
    </a>


    <form method="GET" class="mb-3">
        <div class="form-row">
            <div class="col">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasuk as $bm)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bm->barang->nama_barang }}</td>
                <td>{{ $bm->jumlah }}</td>
                <td>{{ $bm->tanggal }}</td>
                <td>{{ $bm->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
