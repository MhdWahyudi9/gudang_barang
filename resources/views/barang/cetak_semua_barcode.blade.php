@extends('layouts.app')

@section('title', 'Cetak Semua Barcode')

@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp

<div class="container-fluid text-center">

    <h3 class="mb-4">Cetak Semua Barcode</h3>

    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($barang as $b)
        <div style="width: 150px; margin: 5px; text-align: center;">
            {!! DNS1D::getBarcodeHTML($b->kode_barang, 'C128', 1.4, 50) !!}
            <small style="display: block; margin-top: -5px;">{{ $b->kode_barang }}</small>
        </div>
        @endforeach
    </div>

    <button class="btn btn-success mt-3" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>

</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .container-fluid, .container-fluid * {
        visibility: visible;
    }
    .container-fluid {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    button {
        display: none !important;
    }
}
</style>
@endsection
