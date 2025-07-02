@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp

<style>
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

    /* Badge stok */
    .badge {
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
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

    /* Modal gambar */
    #imageModal img {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    #imageModal img:hover {
        transform: scale(1.03);
        box-shadow: 0 0 20px rgba(255,255,255,0.4);
    }
</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="judul-page">Daftar Barang</h1>

    <!-- Tombol -->
    <div class="mb-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-action me-2">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
        <a href="{{ route('barang.cetak_semua_barcode') }}" class="btn btn-success btn-action" target="_blank">
            <i class="fas fa-print"></i> Cetak Semua Barcode
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm fw-semibold">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Barcode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $b->nama_barang }}</td>
                            <td>{{ $b->kode_barang }}</td>
                            <td>{{ $b->kategori }}</td>
                            <td class="text-center">
                                @if($b->stok == 0)
                                    <span class="badge bg-danger">Habis</span>
                                @elseif($b->stok <= 5)
                                    <span class="badge bg-warning text-dark">{{ $b->stok }}</span>
                                @else
                                    <span class="badge bg-success">{{ $b->stok }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($b->foto)
                                    <img 
                                        src="{{ asset('storage/' . $b->foto) }}" 
                                        alt="Foto" 
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; cursor: pointer;" 
                                        onclick="openImage('{{ asset('storage/' . $b->foto) }}')">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    {!! DNS1D::getBarcodeHTML($b->kode_barang, 'C128') !!}
                                    <small>{{ $b->kode_barang }}</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('barang.cetak_barcode', $b->id_barang) }}" class="btn btn-sm btn-info btn-action mb-1" title="Cetak Barcode">
                                    <i class="fas fa-barcode"></i> Cetak
                                </a>
                                <a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-sm btn-warning btn-action mb-1" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Yakin hapus?')" title="Hapus">
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

<!-- Modal Preview Foto -->
<div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
    <img id="modalImage" src="" style="max-width:90%; max-height:90%; border: 5px solid white; border-radius: 12px;">
</div>
@endsection

@push('scripts')
<script>
    function openImage(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').style.display = 'flex';
    }

    document.getElementById('imageModal').addEventListener('click', function() {
        this.style.display = 'none';
    });
</script>
@endpush
