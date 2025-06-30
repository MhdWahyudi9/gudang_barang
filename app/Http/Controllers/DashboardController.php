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

        $totalStok = Barang::sum('stok');
        $totalMasuk = BarangMasuk::sum('jumlah');
        $totalKeluar = BarangKeluar::sum('jumlah');

        if ($filter == 'monthly') {
            $barangMasuk = BarangMasuk::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();

            $barangKeluar = BarangKeluar::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } elseif ($filter == 'yearly') {
            $barangMasuk = BarangMasuk::selectRaw('YEAR(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();

            $barangKeluar = BarangKeluar::selectRaw('YEAR(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } else { // default daily
            $barangMasuk = BarangMasuk::selectRaw('DATE(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();

            $barangKeluar = BarangKeluar::selectRaw('DATE(tanggal) as label, SUM(jumlah) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        return view('dashboard.index', compact(
            'totalStok',
            'totalMasuk',
            'totalKeluar',
            'barangMasuk',
            'barangKeluar',
            'filter'
        ));
    }
}
