@extends('layouts.app')

@section('title', 'Cetak Semua Barcode')

@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp

<div class="container-fluid text-center">
    <button class="btn btn-success mt-3" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>
    
    <div class="d-flex flex-wrap justify-content-center">
       @foreach ($barangs as $b)
            <div style="display: inline-block; margin: 5px; padding: 5px 10px; border: 1px dashed #aaa; text-align: center;">
                <div style="display: block;">
                    {!! DNS1D::getBarcodeHTML($b->kode_barang, 'C128', 1.5, 50) !!}
                </div>
                <div style="margin-top: 4px; font-size: 12px; text-align: center;">
                    {{ $b->kode_barang }}
                </div>
            </div>
        @endforeach

    </div>



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
