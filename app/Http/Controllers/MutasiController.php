<?php

namespace App\Http\Controllers;

use App\Models\MutasiPenduduk;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MutasiController extends Controller
{
    public function index(Request $request): View
    {
        $jenisMutasi = $request->get('jenis_mutasi');
        $mutasi = MutasiPenduduk::with(['penduduk', 'dibuatOleh'])
            ->when($jenisMutasi, fn($q) => $q->where('jenis_mutasi', $jenisMutasi))
            ->latest()
            ->paginate(15);

        $penduduk = Penduduk::where('status_penduduk', 'aktif')->orderBy('nama_lengkap')->get();

        return view('mutasi.index', compact('mutasi', 'jenisMutasi', 'penduduk'));
    }

    public function create(): View
    {
        $penduduk = Penduduk::where('status_penduduk', 'aktif')->orderBy('nama_lengkap')->get();
        return view('mutasi.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'penduduk_id' => 'required|exists:penduduk,id',
            'jenis_mutasi' => 'required|in:masuk,keluar,meninggal',
            'tanggal_mutasi' => 'required|date',
            'asal_tujuan' => 'required|string',
            'alasan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $data['dibuat_oleh'] = auth()->id();

        MutasiPenduduk::create($data);

        $statusMap = ['masuk' => 'aktif', 'keluar' => 'pindah', 'meninggal' => 'meninggal'];
        Penduduk::where('id', $data['penduduk_id'])->update(['status_penduduk' => $statusMap[$data['jenis_mutasi']]]);

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil dicatat.');
    }

    public function show(MutasiPenduduk $mutasi): View
    {
        $mutasi->load(['penduduk', 'dibuatOleh']);
        return view('mutasi.show', compact('mutasi'));
    }
}
