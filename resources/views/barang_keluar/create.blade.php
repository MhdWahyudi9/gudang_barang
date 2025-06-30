@extends('layouts.app')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Barang Keluar</h1>

    <!-- Alert Error -->
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Form Scan Barcode -->
            <h5>Scan Barcode (Multi Barang)</h5>
            <form id="scanForm" onsubmit="addItem(event)">
                <div class="form-group">
                    <label>Kode Barang (Scan)</label>
                    <input type="text" id="kode_scan" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" id="jumlah_scan" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-info mt-2">Tambah ke Daftar</button>
            </form>

            <hr>

            <!-- Daftar Scan -->
            <h5>Daftar Barang Scan</h5>
            <form action="{{ route('barang_keluar.store') }}" method="POST" id="mainForm">
                @csrf
                <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                <div id="listItems"></div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Simpan Semua Scan
                </button>
            </form>

            <hr>

            <!-- Form Manual -->
            <h5>Tambah Manual (Satu Barang)</h5>
            <form action="{{ route('barang_keluar.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="id_barang" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Simpan Manual
                </button>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let items = [];

    function addItem(e) {
        e.preventDefault();
        const kode = document.getElementById('kode_scan').value.trim();
        const jumlah = parseInt(document.getElementById('jumlah_scan').value);

        if (!kode || jumlah <= 0) {
            alert('Isi kode dan jumlah dengan benar');
            return;
        }

        items.push({ kode_barang: kode, jumlah: jumlah });
        renderItems();

        document.getElementById('kode_scan').value = '';
        document.getElementById('jumlah_scan').value = 1;
        document.getElementById('kode_scan').focus();
    }

    function hapusItem(index) {
        items.splice(index, 1);
        renderItems();
    }

    function renderItems() {
        const container = document.getElementById('listItems');
        container.innerHTML = '';

        if (items.length === 0) {
            container.innerHTML = '<p class="text-muted">Belum ada barang di-scan.</p>';
            return;
        }

        let html = '<table class="table table-bordered"><thead><tr><th>Kode Barang</th><th>Jumlah</th><th>Aksi</th></tr></thead><tbody>';
        items.forEach((item, index) => {
            html += `
                <tr>
                    <td>
                        ${item.kode_barang}
                        <input type="hidden" name="items[${index}][kode_barang]" value="${item.kode_barang}">
                    </td>
                    <td>
                        ${item.jumlah}
                        <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusItem(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        });
        html += '</tbody></table>';

        container.innerHTML = html;
    }
</script>
@endpush
