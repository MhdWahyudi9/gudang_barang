@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Daftar Barang</h1>

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Barang
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
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Barcode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->kode_barang }}</td>
                            <td>{{ $b->kategori }}</td>
                            <td>
                                @if($b->stok == 0)
                                    <span class="badge badge-danger">Habis</span>
                                @elseif($b->stok <= 5)
                                    <span class="badge badge-warning">{{ $b->stok }}</span>
                                @else
                                    <span class="badge badge-success">{{ $b->stok }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {!! DNS1D::getBarcodeHTML($b->kode_barang, 'C128') !!}
                                <small>{{ $b->kode_barang }}</small>
                            </td>
                            <td>
                                <a href="{{ route('barang.cetak_barcode', $b->id_barang) }}" class="btn btn-sm btn-info" title="Cetak Barcode">
                                    <i class="fas fa-barcode"></i>
                                </a>
                                <a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
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
