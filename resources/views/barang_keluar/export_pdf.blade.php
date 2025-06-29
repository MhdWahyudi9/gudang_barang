<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Barang Keluar</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $index => $bk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bk->barang->nama_barang }}</td>
                <td>{{ $bk->jumlah }}</td>
                <td>{{ $bk->tanggal }}</td>
                <td>{{ $bk->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
