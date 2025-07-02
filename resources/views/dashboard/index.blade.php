@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-gradient-primary text-white shadow mb-4">
                <div class="card-body">Total Stok Barang
                    <div class="h4 mt-2 fw-bold">{{ $totalStok }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-gradient-success text-white shadow mb-4">
                <div class="card-body">Total Barang Masuk
                    <div class="h4 mt-2 fw-bold">{{ $totalMasuk }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-gradient-danger text-white shadow mb-4">
                <div class="card-body">Total Barang Keluar
                    <div class="h4 mt-2 fw-bold">{{ $totalKeluar }}</div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="mb-4 d-flex align-items-center">
        <select name="filter" class="form-control w-auto d-inline rounded shadow-sm">
            <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Harian</option>
            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Bulanan</option>
            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Tahunan</option>
        </select>
        <button type="submit" class="btn btn-primary ml-2 shadow-sm">Tampilkan</button>
    </form>

    <div class="card shadow-lg mb-4">
        <div class="card-body" style="height: 300px;">
            <h5 class="text-center fw-bold mb-3 text-primary">📈 Grafik Barang Masuk</h5>
            <canvas id="grafikMasuk" style="width: 100%; height: 220px;"></canvas>
        </div>
    </div>

    <div class="card shadow-lg">
        <div class="card-body" style="height: 300px;">
            <h5 class="text-center fw-bold mb-3 text-danger">📉 Grafik Barang Keluar</h5>
            <canvas id="grafikKeluar" style="width: 100%; height: 220px;"></canvas>
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
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.2)',
                pointBackgroundColor: '#1cc88a',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#1cc88a',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#333',
                    borderColor: '#ddd',
                    borderWidth: 1,
                }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { color: 'rgba(0,0,0,0.05)' } }
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
                borderColor: '#e74a3b',
                backgroundColor: 'rgba(231, 74, 59, 0.2)',
                pointBackgroundColor: '#e74a3b',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#e74a3b',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#333',
                    borderColor: '#ddd',
                    borderWidth: 1,
                }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { color: 'rgba(0,0,0,0.05)' } }
            }
        }
    });
</script>
@endpush
