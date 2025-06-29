@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Laporan Barang Keluar</h3>
    <a href="{{ route('barang_keluar.export_pdf', request()->all()) }}" class="btn btn-danger mb-3">
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
            @foreach($barangKeluar as $bk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bk->barang->nama_barang }}</td>
                <td>{{ $bk->jumlah }}</td>
                <td>{{ $bk->tanggal }}</td>
                <td>{{ $bk->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
