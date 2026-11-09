<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan | BlueHour</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <p class="text-8xl font-bold text-navy-700">404</p>
        <h1 class="text-2xl font-bold text-gray-900 mt-4">Halaman Tidak Ditemukan</h1>
        <p class="text-gray-500 mt-2 max-w-md mx-auto">
            Halaman yang Anda cari tidak ada atau telah dipindahkan.
        </p>
        <a href="{{ url('/') }}"
           class="mt-8 inline-flex items-center gap-2 btn-primary">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>