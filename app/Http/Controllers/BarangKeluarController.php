<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('barang')->orderBy('tanggal', 'desc')->get();
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah'    => 'required|integer',
            'tanggal'   => 'required|date',
            'keterangan'=> 'nullable'
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $barang->stok -= $request->jumlah;
        $barang->save();

        BarangKeluar::create($request->all());

        return redirect()->route('barang_keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan!');
    }
}

