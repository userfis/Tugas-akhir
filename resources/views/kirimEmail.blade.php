<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <p>Data ID: {{ $data['data']['nomor_surat'] }}</p> --}}
    <p>Email: {{ $data['email'] }}</p>
    <p>Deskripsi: {{ $data['deskripsi'] }}</p>
    <p>Nomor Surat: {{ $data->surat->nomor_surat }}</p>
</body>
</html>