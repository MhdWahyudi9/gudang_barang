@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Barang Keluar</h1>

    <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Barang Keluar
    </a>
    
    <a href="{{ route('barang_keluar.export_pdf') }}" class="btn btn-danger mb-3">
        <i class="fas fa-file-pdf"></i> Export PDF
    </a>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangKeluar as $bk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bk->barang->nama_barang }}</td>
                            <td>{{ $bk->jumlah }}</td>
                            <td>{{ $bk->tanggal }}</td>
                            <td>{{ $bk->keterangan }}</td>
                            <td>
                                <a href="{{ route('barang_keluar.edit', $bk->id_keluar) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
