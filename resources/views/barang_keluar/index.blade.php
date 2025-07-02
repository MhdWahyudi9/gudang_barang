@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<style>
    /* Header tabel polos */
    .table thead th {
        background-color: #4e73df;
        color: white !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
        text-align: center;
    }

    /* Isi tabel */
    .table td {
        font-weight: 500;
        color: #343a40;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transition: all 0.3s;
    }

    /* Tombol */
    .btn-action {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.12);
        transition: all 0.3s;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-action i {
        margin-right: 4px;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Judul keren */
    .judul-page {
        font-weight: 800;
        font-size: 2rem;
        background: linear-gradient(90deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        display: inline-block;
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="judul-page">Data Barang Keluar</h1>

    <!-- Tombol -->
    <div class="mb-3">
        <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary btn-action me-2">
            <i class="fas fa-plus"></i> Tambah Barang Keluar
        </a>
        <a href="{{ route('barang_keluar.export_pdf') }}" class="btn btn-danger btn-action">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm fw-semibold">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger shadow-sm fw-semibold">{{ session('error') }}</div>
    @endif

    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangKeluar as $bk)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $bk->barang->nama_barang }}</td>
                            <td class="text-center">{{ $bk->jumlah }}</td>
                            <td>{{ $bk->tanggal }}</td>
                            <td>{{ $bk->keterangan }}</td>
                            <td class="text-center">
                                <a href="{{ route('barang_keluar.edit', $bk->id_keluar) }}" class="btn btn-sm btn-warning btn-action mb-1" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('barang_keluar.destroy', $bk->id_keluar) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Yakin ingin hapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
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
