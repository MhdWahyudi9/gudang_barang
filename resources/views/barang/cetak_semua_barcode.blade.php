@extends('layouts.app')

@section('title', 'Cetak Semua QR Code')

@section('content')
@php
    use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

    $sizeOption = request('size', 'medium');

    switch ($sizeOption) {
        case 'small':
            $scaleX = 3;
            $scaleY = 3;
            break;
        case 'large':
            $scaleX = 7;
            $scaleY = 7;
            break;
        default:
            $scaleX = 5;
            $scaleY = 5;
            break;
    }
@endphp

<div class="container-fluid text-center" style="margin-top: 0;">
    <form method="GET" class="print-hide mb-4">
        <label for="size" class="form-label fw-bold">Ukuran QR Code</label>
        <select name="size" id="size" class="form-select d-inline-block w-auto mx-2">
            <option value="small" {{ $sizeOption == 'small' ? 'selected' : '' }}>Kecil</option>
            <option value="medium" {{ $sizeOption == 'medium' ? 'selected' : '' }}>Sedang</option>
            <option value="large" {{ $sizeOption == 'large' ? 'selected' : '' }}>Besar</option>
        </select>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <button class="btn btn-success print-hide mb-3" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>
    
    <div class="d-flex flex-wrap justify-content-center">
       @foreach ($barangs as $b)
            <div style="
                display: inline-block; 
                margin: 4px; 
                padding: 6px 8px; 
                border: 1px dashed #aaa; 
                text-align: center; 
                background: #fff;
            ">
                <div style="display: block;">
                    {!! DNS2D::getBarcodeHTML($b->kode_barang, 'QRCODE', $scaleX, $scaleY) !!}
                </div>
                <div style="margin-top: 4px; font-size: 11px; text-align: center;">
                    {{ $b->kode_barang }}
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
@media print {
    @page {
        margin: 0;
    }
    body {
        margin: 0;
    }
    body * {
        visibility: hidden;
    }
    .container-fluid, .container-fluid * {
        visibility: visible;
    }
    .container-fluid {
        position: absolute;
        left: 0;
        top: 0; /* mepet atas */
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
    }
    button, form {
        display: none !important;
    }
}
</style>
@endsection
