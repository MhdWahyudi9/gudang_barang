@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Ringkasan -->
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

    <!-- Filter grafik -->
    <form method="GET" class="mb-3">
        <select name="filter" class="form-control w-auto d-inline">
            <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Harian</option>
            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Bulanan</option>
            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Tahunan</option>
        </select>
        <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
    </form>

    <!-- Chart -->
    <div class="card shadow">
        <div class="card-body">
            <canvas id="grafikBarang"></canvas>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikBarang').getContext('2d');

    const barangMasukData = @json($barangMasuk);
    const barangKeluarData = @json($barangKeluar);

    const labels = barangMasukData.map(item => item.label);

    const masukData = barangMasukData.map(item => item.total);
    const keluarData = barangKeluarData.map(item => item.total);

    console.log('Labels:', labels);
    console.log('Masuk:', masukData);
    console.log('Keluar:', keluarData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: masukData,
                    borderColor: 'green',
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    fill: true,
                },
                {
                    label: 'Barang Keluar',
                    data: keluarData,
                    borderColor: 'red',
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                },
            }
        }
    });
</script>
@endpush
