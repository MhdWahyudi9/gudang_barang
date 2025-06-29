<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'daily';

        $totalStok   = Barang::sum('stok');
        $totalMasuk  = BarangMasuk::sum('jumlah');
        $totalKeluar = BarangKeluar::sum('jumlah');

        // Default daily
        $masukQuery = BarangMasuk::selectRaw('DATE(tanggal) as label, SUM(jumlah) as total')
            ->groupBy('label')
            ->orderBy('label');

        $keluarQuery = BarangKeluar::selectRaw('DATE(tanggal) as label, SUM(jumlah) as total')
            ->groupBy('label')
            ->orderBy('label');

        // Monthly
        if ($filter === 'monthly') {
            $masukQuery = BarangMasuk::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label');

            $keluarQuery = BarangKeluar::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label');

        // Yearly
        } elseif ($filter === 'yearly') {
            $masukQuery = BarangMasuk::selectRaw('YEAR(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label');

            $keluarQuery = BarangKeluar::selectRaw('YEAR(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label');
        }

        $barangMasuk  = $masukQuery->get();
        $barangKeluar = $keluarQuery->get();

        return view('dashboard.index', compact(
            'totalStok', 'totalMasuk', 'totalKeluar', 'barangMasuk', 'barangKeluar', 'filter'
        ));
    }
}
