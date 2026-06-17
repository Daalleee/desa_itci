<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKartuKeluargaRequest;
use App\Http\Requests\UpdateKartuKeluargaRequest;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KartuKeluargaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $kartuKeluarga = KartuKeluarga::with('kepalaKeluarga')
            ->when($search, function ($q) use ($search) {
                $q->where('nomor_kk', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        $penduduk = Penduduk::orderBy('nama_lengkap')->get(['id', 'nik', 'nama_lengkap']);

        return view('kartu-keluarga.index', compact('kartuKeluarga', 'search', 'penduduk'));
    }

    public function create(): View
    {
        $wilayah = Wilayah::where('aktif', true)->get();
        return view('kartu-keluarga.create', compact('wilayah'));
    }

    public function store(StoreKartuKeluargaRequest $request)
    {
        KartuKeluarga::create($request->validated());

        return redirect()->route('kartu-keluarga.index')->with('success', 'KK berhasil ditambahkan.');
    }

    public function show(KartuKeluarga $kartuKeluarga): View
    {
        $kartuKeluarga->load(['wilayah', 'kepalaKeluarga']);
        $anggota = Penduduk::where('kartu_keluarga_id', $kartuKeluarga->id)->get();

        return view('kartu-keluarga.show', compact('kartuKeluarga', 'anggota'));
    }

    public function edit(KartuKeluarga $kartuKeluarga): View
    {
        $wilayah = Wilayah::where('aktif', true)->get();
        return view('kartu-keluarga.edit', compact('kartuKeluarga', 'wilayah'));
    }

    public function update(UpdateKartuKeluargaRequest $request, KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->update($request->validated());

        return redirect()->route('kartu-keluarga.index')->with('success', 'KK berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->delete();
        return redirect()->route('kartu-keluarga.index')->with('success', 'KK berhasil dihapus.');
    }
}
