<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\Surat;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPenduduk = Penduduk::count();
        $totalKK = KartuKeluarga::count();
        $totalLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'P')->count();
        $suratHariIni = Surat::whereDate('created_at', today())->count();
        $suratBulanIni = Surat::whereMonth('created_at', now()->month)->count();
        $totalBerita = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalGaleri = Galeri::count();

        return view('dashboard.index', compact(
            'totalPenduduk', 'totalKK', 'totalLaki', 'totalPerempuan',
            'suratHariIni', 'suratBulanIni',
            'totalBerita', 'totalPengumuman', 'totalGaleri',
        ));
    }
}
