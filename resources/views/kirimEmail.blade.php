<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
</head>
<body>
    <p><strong>Nomor Surat:</strong> {{ $data->surat->nomor_surat }}</p>
    <p><strong>Nama Data:</strong> {{ $data->surat->judul }}</p>
    <p><strong>File:</strong> <a href="{{ asset('storage/' . $data->surat->file) }}" download>{{ $data->surat->judul }}</a></p>
</body>
</html>