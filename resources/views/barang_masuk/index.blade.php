@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Barang Masuk</h1>

    <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Barang Masuk
    </a>

    <a href="{{ route('barang_masuk.export_pdf') }}" class="btn btn-danger mb-3">
        <i class="fas fa-file-pdf"></i> Export PDF
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
                        @foreach ($barangMasuk as $bm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bm->barang->nama_barang }}</td>
                            <td>{{ $bm->jumlah }}</td>
                            <td>{{ $bm->tanggal }}</td>
                            <td>{{ $bm->keterangan }}</td>
                            <td>
                                <a href="{{ route('barang_masuk.edit', $bm->id_masuk) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('barang_masuk.edit', $bm->id_masuk) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('barang_masuk.destroy', $bm->id_masuk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
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
