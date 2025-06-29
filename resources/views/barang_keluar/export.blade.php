<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>Laporan Barang Keluar</h3>
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
            @foreach($barangKeluar as $bk)
            <tr>
                <td>{{ $loop->iteration }}</td>
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
