@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<style>
    /* Judul style */
    .judul-tombol {
        display: inline-block;
        padding: 12px 35px;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        background: linear-gradient(90deg, #4e73df, #1cc88a);
        border: none;
        border-radius: 50px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
        transition: all 0.3s;
    }
    .judul-tombol:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .card-custom {
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        padding: 30px;
    }

    .label-button {
        display: block;
        width: 100%;
        background-color: rgba(78, 115, 223, 0.15);
        color: #4e73df;
        font-weight: 600;
        text-align: left;
        border-radius: 8px;
        padding: 8px 15px;
        margin-bottom: 6px;
        letter-spacing: 0.5px;
    }

    .form-control, select {
        border-radius: 10px;
        border: 1px solid #d1d3e2;
        transition: all 0.3s;
        font-size: 1rem;
    }
    .form-control::placeholder {
        color: #a0a4ac;
        font-style: italic;
    }
    .form-control:focus, select:focus {
        box-shadow: 0 0 10px rgba(78, 115, 223, 0.3);
        border-color: #4e73df;
    }

    .btn-submit {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.12);
        transition: all 0.3s;
        font-weight: 700;
        font-size: 1rem;
    }
    .btn-submit i {
        margin-right: 5px;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }
</style>

<div class="container-fluid d-flex justify-content-center">

    <div class="w-100" style="max-width: 700px;">

        <h1 class="judul-tombol text-center">Tambah Barang Masuk</h1>

        <div class="card card-custom mb-5">

            <div class="card-body text-start">

                <form action="{{ route('barang_masuk.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <span class="label-button">Pilih Barang</span>
                        <select name="id_barang" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <span class="label-button">Jumlah</span>
                        <input type="number" name="jumlah" class="form-control" required placeholder="Masukkan jumlah barang">
                    </div>

                    <div class="mb-3">
                        <span class="label-button">Tanggal</span>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <span class="label-button">Keterangan</span>
                        <input type="text" name="keterangan" class="form-control" placeholder="Opsional">
                    </div>

                    <button type="submit" class="btn btn-success btn-submit w-100">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
