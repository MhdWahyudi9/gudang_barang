@extends('layouts.app')

@section('title', 'Cetak QR Code')

@section('content')
@php
    use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

    $sizeOption = request('size', 'medium'); // default medium

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

<style>
.print-hide {
    display: block;
}
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
        margin: 0;
        padding: 0;
    }
    .print-hide {
        display: none !important;
    }
}
</style>

<div class="container-fluid text-center" style="margin-top: 20px;">
    <form method="GET" class="print-hide mb-4">
        <label for="jumlah" class="form-label fw-bold">Jumlah QR yang Dicetak</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control d-inline-block w-auto mx-2" value="{{ request('jumlah', 1) }}" min="1">

        <label for="size" class="form-label fw-bold ms-3">Ukuran</label>
        <select name="size" id="size" class="form-select d-inline-block w-auto mx-2">
            <option value="small" {{ $sizeOption == 'small' ? 'selected' : '' }}>Kecil</option>
            <option value="medium" {{ $sizeOption == 'medium' ? 'selected' : '' }}>Sedang</option>
            <option value="large" {{ $sizeOption == 'large' ? 'selected' : '' }}>Besar</option>
        </select>

        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <button class="btn btn-success print-hide mb-3" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak
    </button>

    <div class="d-flex flex-wrap justify-content-center">
        @for ($i = 0; $i < request('jumlah', 1); $i++)
            <div style="
                display: inline-block;
                margin: 4px;
                padding: 6px 8px;
                border: 1px dashed #aaa;
                text-align: center;
                background: #fff;
            ">
                <div style="display: block;">
                    {!! DNS2D::getBarcodeHTML($barang->kode_barang, 'QRCODE', $scaleX, $scaleY) !!}
                </div>
                <div style="margin-top: 4px; font-size: 11px; text-align: center;">
                    {{ $barang->kode_barang }}
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
