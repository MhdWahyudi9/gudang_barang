<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang')->orderBy('tanggal', 'desc')->get();
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('barang_masuk.create', compact('barang'));
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
        $barang->stok += $request->jumlah;
        $barang->save();

        BarangMasuk::create($request->all());

        return redirect()->route('barang_masuk.index')->with('success', 'Data barang masuk berhasil ditambahkan!');
    }
}

