<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
        }
        th {
            padding: 5px;
            background: whitesmoke;
        }
    </style>

    <center><br>
    <h2>Laporan Barang Masuk</h2>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Masuk</th>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Supplier</th>
                <th>Jumlah Masuk</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($bm as $data)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$data->tanggal_masuk}}</td>
                        <td>{{$data->kode_barang_masuk}}</td>
                        <td>{{$data->barang->nama_barang}}</td>
                        <td>{{$data->supplier->nama_supplier}}</td>
                        <td><center>{{$data->qty}}</center></td>
                    </tr>
                    @endforeach
        </tbody>
    </table>
    </center>

</body>
</html>
