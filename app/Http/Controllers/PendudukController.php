<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Agama;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendudukController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $penduduk = Penduduk::with(['kartuKeluarga.wilayah', 'agama'])
            ->when($search, function ($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        $agama = Agama::where('aktif', true)->get();
        $kartuKeluarga = KartuKeluarga::with('kepalaKeluarga')->where('status', 'aktif')->get();

        return view('penduduk.index', compact('penduduk', 'search', 'agama', 'kartuKeluarga'));
    }

    public function create()
    {
        return redirect()->route('penduduk.index');
    }

    public function store(StorePendudukRequest $request)
    {
        $data = $request->validated();

        if ($request->input('_peran') === 'kepala_keluarga') {
            $kk = KartuKeluarga::create([
                'nomor_kk' => $request->input('nomor_kk_baru'),
                'rt' => $request->input('rt_baru'),
                'rw' => $request->input('rw_baru'),
                'alamat' => $request->input('alamat_baru'),
                'status' => 'aktif',
            ]);
            $data['kartu_keluarga_id'] = $kk->id;
            $data['hubungan_keluarga'] = 'kepala_keluarga';
        } else {
            $data['hubungan_keluarga'] = match ($request->input('_peran')) {
                'istri' => 'istri',
                'anak' => 'anak',
                default => 'kerabat',
            };
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-penduduk', 'public');
        }

        $data['status_penduduk'] ??= 'aktif';
        $data['kode_warga'] = 'WRG-' . str_pad(Penduduk::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $data['pekerjaan'] ??= '';
        $data['pendidikan'] ??= '';
        $data['golongan_darah'] ??= '';
        $data['nomor_telepon'] ??= '';

        $penduduk = Penduduk::create($data);

        if ($request->input('_peran') === 'kepala_keluarga') {
            $kk->update(['kepala_keluarga_id' => $penduduk->id]);
        }

        $msg = $request->input('_peran') === 'kepala_keluarga'
            ? 'Keluarga baru berhasil ditambahkan.'
            : 'Data penduduk berhasil ditambahkan.';

        return redirect()->route('penduduk.index')->with('success', $msg);
    }

    public function show(Penduduk $penduduk): View
    {
        $penduduk->load(['kartuKeluarga.wilayah', 'agama']);

        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return redirect()->route('penduduk.index');
    }

    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-penduduk', 'public');
        }

        $data['status_penduduk'] ??= $penduduk->status_penduduk;
        $data['pekerjaan'] ??= '';
        $data['pendidikan'] ??= '';
        $data['hubungan_keluarga'] ??= '';
        $data['golongan_darah'] ??= '';
        $data['nomor_telepon'] ??= '';

        $penduduk->update($data);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}
