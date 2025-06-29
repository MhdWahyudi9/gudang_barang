@extends('layouts.app')

@section('title', 'Cetak Barcode')

@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp

<div class="container-fluid text-center">
    <button class="btn btn-success mt-3 print-hide" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>
    <div style="display: inline-block; margin: 10px; padding: 5px 10px; border: 1px dashed #aaa; text-align: center;">
        <div style="display: block;">
            {!! DNS1D::getBarcodeHTML($barang->kode_barang, 'C128', 1.5, 50) !!}
        </div>
        <div style="margin-top: 4px; font-size: 12px; text-align: center;">
            {{ $barang->kode_barang }}
        </div>
    </div>



</div>

<style>
.print-hide {
    display: block;
}

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
    .print-hide {
        display: none !important;
    }
}
</style>
@endsection
