<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan untuk tampilan PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Arsip</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Agenda</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Asal Surat</th>
                <th>Lampiran</th>
                <th>Tanggal Arsip</th>
                <th>Kode Rak</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arsip as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->nomor_agenda }}</td>
                <td>{{ $t->nomor_surat }}</td>
                <td>{{ $t->perihal }}</td>
                <td>{{ $t->asal_surat }}</td>
                <td>{{ $t->lampiran }}</td>
                <td>{{ $t->arsip->tanggal_arsip }}</td>
                <td>{{ $t->arsip->rak->nama_rak }}</td>
                <td>{{ $t->arsip->file }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
