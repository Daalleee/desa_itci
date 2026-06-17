<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa ITCI - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <div class="p-4 border-b border-gray-200">
                <h1 class="text-lg font-bold text-green-800">Desa ITCI</h1>
                <p class="text-xs text-gray-500">Sistem Informasi Penduduk</p>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span>Dashboard</span>
                </a>
                <div class="pt-4">
                    <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider">Data Keluarga</p>
                </div>
                <a href="{{ route('keluarga.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('keluarga.*') ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span>Daftar Keluarga</span>
                </a>
                <a href="{{ route('mutasi.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('mutasi.*') ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span>Mutasi Penduduk</span>
                </a>
                <div class="pt-4">
                    <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider">Surat</p>
                </div>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Buat Surat</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Riwayat Surat</span>
                </a>
                <div class="pt-4">
                    <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider">Website</p>
                </div>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Profil Desa</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Berita</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Galeri</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Potensi Desa</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Pengumuman</span>
                </a>
                <div class="pt-4">
                    <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider">Pengaturan</p>
                </div>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg text-gray-700 hover:bg-gray-50">
                    <span>Import Excel</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        <main class="flex-1">
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('modals')
    @stack('scripts')
<script>
    setTimeout(function() {
        var el = document.querySelector('[class*="bg-green-100"][class*="text-green-700"], [class*="bg-red-100"][class*="text-red-700"]');
        if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(function() { el.remove(); }, 500); }
    }, 5000);
</script>
</body>
</html>
