<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>
<body>
    <p><strong>Nomor Surat:</strong> {{ $encryptedData->nomor_surat }}</p>
    <p><strong>Nama Data:</strong> {{ $encryptedData->judul }}</p>
    <p><strong>File:</strong> <a href="{{ asset('storage/' . $encryptedData->file) }}" download>{{ $encryptedData->judul }}</a></p>
</body>
</html>
