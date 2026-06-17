<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa ITCI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-800 mb-2">DESA ITCI</h1>
            <p class="text-gray-600">Sistem Informasi Penduduk dan Profil Desa ITCI</p>
            <p class="text-gray-500 text-sm mt-1">Penajam Paser Utara, Kalimantan Timur</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-green-700 text-white font-medium rounded-lg hover:bg-green-800 transition">
                Masuk ke Sistem
            </a>
        </div>
    </div>
</body>
</html>
