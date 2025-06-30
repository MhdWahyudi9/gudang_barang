@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow mb-4">
                <div class="card-body">Total Stok Barang
                    <div class="h4 mt-2">{{ $totalStok }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow mb-4">
                <div class="card-body">Total Barang Masuk
                    <div class="h4 mt-2">{{ $totalMasuk }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white shadow mb-4">
                <div class="card-body">Total Barang Keluar
                    <div class="h4 mt-2">{{ $totalKeluar }}</div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="mb-3">
        <select name="filter" class="form-control w-auto d-inline">
            <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Harian</option>
            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Bulanan</option>
            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Tahunan</option>
        </select>
        <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body" style="height: 250px;">
            <h5 class="text-center">Grafik Barang Masuk</h5>
            <canvas id="grafikMasuk" style="width: 100%; height: 180px;"></canvas>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body" style="height: 250px;">
            <h5 class="text-center">Grafik Barang Keluar</h5>
            <canvas id="grafikKeluar" style="width: 100%; height: 180px;"></canvas>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const barangMasuk = @json($barangMasuk);
    const barangKeluar = @json($barangKeluar);

    const masukLabels = barangMasuk.map(item => item.label);
    const masukData = barangMasuk.map(item => item.total);

    const keluarLabels = barangKeluar.map(item => item.label);
    const keluarData = barangKeluar.map(item => item.total);

    new Chart(document.getElementById('grafikMasuk'), {
        type: 'line',
        data: {
            labels: masukLabels,
            datasets: [{
                label: 'Barang Masuk',
                data: masukData,
                borderColor: 'green',
                backgroundColor: 'rgba(0,255,0,0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // ✅ supaya tinggi sesuai style
            plugins: {
                legend: { position: 'top' },
            }
        }
    });

    new Chart(document.getElementById('grafikKeluar'), {
        type: 'line',
        data: {
            labels: keluarLabels,
            datasets: [{
                label: 'Barang Keluar',
                data: keluarData,
                borderColor: 'red',
                backgroundColor: 'rgba(255,0,0,0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // ✅ supaya tinggi sesuai style
            plugins: {
                legend: { position: 'top' },
            }
        }
    });
</script>
@endpush
