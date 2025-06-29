<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    private function generateKodeBarang()
    {
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();

        if (!$lastBarang) {
            $kode = 'BRG-0001';
        } else {
            $lastNumber = intval(substr($lastBarang->kode_barang, 4));
            $newNumber = $lastNumber + 1;
            $kode = 'BRG-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        return $kode;
    }

    public function create()
    {
        $kode_barang = $this->generateKodeBarang();
        return view('barang.create', compact('kode_barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori'    => 'nullable',
            'stok'        => 'required|integer',
        ]);

        $kode_barang = $this->generateKodeBarang();

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $kode_barang,
            'kategori'    => $request->kategori,
            'stok'        => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id . ',id_barang',
            'kategori'    => 'nullable',
            'stok'        => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function cetakBarcode($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.cetak_barcode', compact('barang'));
    }
}
