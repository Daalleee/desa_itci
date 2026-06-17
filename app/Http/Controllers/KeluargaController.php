<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KeluargaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $keluarga = KartuKeluarga::with(['kepalaKeluarga', 'anggotaKeluarga' => fn($q) => $q->orderByRaw("FIELD(hubungan_keluarga, 'kepala_keluarga','istri','anak_kandung','anak_angkat','anak_tiri','ayah','ibu','mertua','paman','bibi','sepupu','keponakan','kerabat')")->orderBy('tanggal_lahir')])
            ->when($search, function ($q) use ($search) {
                $q->where('nomor_kk', 'like', "%{$search}%")
                  ->orWhereHas('kepalaKeluarga', fn($q) => $q->where('nama_lengkap', 'like', "%{$search}%"))
                  ->orWhereHas('anggotaKeluarga', fn($q) => $q->where('nama_lengkap', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(15);

        return view('keluarga.index', compact('keluarga', 'search'));
    }

    public function create(): View
    {
        $agama = Agama::where('aktif', true)->get();

        return view('keluarga.create', compact('agama'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Step 1 - Info Keluarga
            'nomor_kk' => 'required|string|max:20|unique:kartu_keluarga,nomor_kk',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'alamat' => 'required|string',
            'kode_pos' => 'nullable|string|max:10',
            'kk_nomor_telepon' => 'nullable|string|max:20',

            // Step 2 - Kepala Keluarga
            'nik' => 'required|string|size:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama_id' => 'required|exists:agama,id',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'required|string',
            'golongan_darah' => 'nullable|string|max:5',
            'nik_nomor_telepon' => 'nullable|string|max:20',

            // Step 3 - Anggota Keluarga (array)
            'anggota' => 'nullable|array',
            'anggota.*.nik' => 'required|string|size:16|unique:penduduk,nik',
            'anggota.*.nama_lengkap' => 'required|string|max:255',
            'anggota.*.tempat_lahir' => 'required|string|max:100',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.jenis_kelamin' => 'required|in:L,P',
            'anggota.*.agama_id' => 'required|exists:agama,id',
            'anggota.*.pendidikan' => 'nullable|string|max:100',
            'anggota.*.pekerjaan' => 'nullable|string|max:100',
            'anggota.*.status_perkawinan' => 'required|string',
            'anggota.*.hubungan_keluarga' => 'required|in:istri,anak,orang_tua,kerabat',
            'anggota.*.status_anak' => 'nullable|required_if:anggota.*.hubungan_keluarga,anak|in:anak_kandung,anak_angkat,anak_tiri',
            'anggota.*.hubungan_orang_tua' => 'nullable|required_if:anggota.*.hubungan_keluarga,orang_tua|in:ayah,ibu,mertua',
            'anggota.*.hubungan_kerabat' => 'nullable|required_if:anggota.*.hubungan_keluarga,kerabat|in:paman,bibi,sepupu,keponakan,lainnya',
            'anggota.*.hubungan_kerabat_lainnya' => 'nullable|string|max:100',
        ], [
            'nomor_kk.required' => 'Nomor KK wajib diisi.',
            'nomor_kk.unique' => 'Nomor KK sudah terdaftar.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'nik.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik.size' => 'NIK harus 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'anggota.*.nik.required' => 'NIK anggota wajib diisi.',
            'anggota.*.nik.unique' => 'NIK anggota sudah terdaftar.',
            'anggota.*.nik.size' => 'NIK anggota harus 16 karakter.',
            'anggota.*.hubungan_keluarga.required' => 'Hubungan keluarga wajib dipilih.',
        ]);

        return DB::transaction(function () use ($request, $data) {
            $kk = KartuKeluarga::create([
                'nomor_kk' => $data['nomor_kk'],
                'rt' => $data['rt'],
                'rw' => $data['rw'],
                'alamat' => $data['alamat'],
                'kode_pos' => $data['kode_pos'] ?? null,
                'nomor_telepon' => $data['kk_nomor_telepon'] ?? null,
                'status' => 'aktif',
            ]);

            $kepala = Penduduk::create([
                'kartu_keluarga_id' => $kk->id,
                'kode_warga' => 'WRG-' . str_pad(Penduduk::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'nik' => $data['nik'],
                'nama_lengkap' => $data['nama_lengkap'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'agama_id' => $data['agama_id'],
                'pendidikan' => $data['pendidikan'] ?? '',
                'pekerjaan' => $data['pekerjaan'] ?? '',
                'status_perkawinan' => $data['status_perkawinan'],
                'golongan_darah' => $data['golongan_darah'] ?? '',
                'nomor_telepon' => $data['nik_nomor_telepon'] ?? '',
                'hubungan_keluarga' => 'kepala_keluarga',
                'status_penduduk' => 'aktif',
            ]);

            $kk->update(['kepala_keluarga_id' => $kepala->id]);

            if (!empty($data['anggota'])) {
                foreach ($data['anggota'] as $a) {
                    $hubungan = $a['hubungan_keluarga'];
                    $hubunganLabel = $hubungan;

                    if ($hubungan === 'anak' && !empty($a['status_anak'])) {
                        $hubunganLabel = $a['status_anak'];
                    } elseif ($hubungan === 'orang_tua' && !empty($a['hubungan_orang_tua'])) {
                        $hubunganLabel = $a['hubungan_orang_tua'];
                    } elseif ($hubungan === 'kerabat') {
                        $hubunganLabel = $a['hubungan_kerabat'] === 'lainnya'
                            ? ($a['hubungan_kerabat_lainnya'] ?? 'kerabat')
                            : ($a['hubungan_kerabat'] ?? 'kerabat');
                    }

                    Penduduk::create([
                        'kartu_keluarga_id' => $kk->id,
                        'kode_warga' => 'WRG-' . str_pad(Penduduk::max('id') + 1, 5, '0', STR_PAD_LEFT),
                        'nik' => $a['nik'],
                        'nama_lengkap' => $a['nama_lengkap'],
                        'tempat_lahir' => $a['tempat_lahir'],
                        'tanggal_lahir' => $a['tanggal_lahir'],
                        'jenis_kelamin' => $a['jenis_kelamin'],
                        'agama_id' => $a['agama_id'],
                        'pendidikan' => $a['pendidikan'] ?? '',
                        'pekerjaan' => $a['pekerjaan'] ?? '',
                        'status_perkawinan' => $a['status_perkawinan'],
                        'golongan_darah' => '',
                        'nomor_telepon' => '',
                        'hubungan_keluarga' => $hubunganLabel,
                        'status_penduduk' => 'aktif',
                    ]);
                }
            }

            return redirect()->route('keluarga.show', $kk)->with('success', 'Keluarga baru berhasil ditambahkan.');
        });
    }

    public function show(KartuKeluarga $keluarga): View
    {
        $keluarga->load(['kepalaKeluarga', 'anggotaKeluarga' => fn($q) => $q->orderByRaw("FIELD(hubungan_keluarga, 'kepala_keluarga','istri','anak_kandung','anak_angkat','anak_tiri','ayah','ibu','mertua','paman','bibi','sepupu','keponakan','kerabat')")->orderBy('tanggal_lahir')]);
        $anggotaGrouped = $keluarga->anggotaKeluarga->groupBy('hubungan_keluarga');
        $agama = Agama::where('aktif', true)->get();

        return view('keluarga.show', compact('keluarga', 'anggotaGrouped', 'agama'));
    }

    public function storeAnggota(Request $request, KartuKeluarga $keluarga)
    {
        $data = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama_id' => 'required|exists:agama,id',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'required|string',
            'hubungan_keluarga' => 'required|in:istri,anak,orang_tua,kerabat',
            'status_anak' => 'nullable|required_if:hubungan_keluarga,anak|in:anak_kandung,anak_angkat,anak_tiri',
            'hubungan_orang_tua' => 'nullable|required_if:hubungan_keluarga,orang_tua|in:ayah,ibu,mertua',
            'hubungan_kerabat' => 'nullable|required_if:hubungan_keluarga,kerabat|in:paman,bibi,sepupu,keponakan,lainnya',
            'hubungan_kerabat_lainnya' => 'nullable|string|max:100',
        ]);

        $hubungan = $data['hubungan_keluarga'];
        $hubunganLabel = $hubungan;
        if ($hubungan === 'anak' && !empty($data['status_anak'])) {
            $hubunganLabel = $data['status_anak'];
        } elseif ($hubungan === 'orang_tua' && !empty($data['hubungan_orang_tua'])) {
            $hubunganLabel = $data['hubungan_orang_tua'];
        } elseif ($hubungan === 'kerabat') {
            $hubunganLabel = $data['hubungan_kerabat'] === 'lainnya'
                ? ($data['hubungan_kerabat_lainnya'] ?? 'kerabat')
                : ($data['hubungan_kerabat'] ?? 'kerabat');
        }

        Penduduk::create([
            'kartu_keluarga_id' => $keluarga->id,
            'kode_warga' => 'WRG-' . str_pad(Penduduk::max('id') + 1, 5, '0', STR_PAD_LEFT),
            'nik' => $data['nik'],
            'nama_lengkap' => $data['nama_lengkap'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'agama_id' => $data['agama_id'],
            'pendidikan' => $data['pendidikan'] ?? '',
            'pekerjaan' => $data['pekerjaan'] ?? '',
            'status_perkawinan' => $data['status_perkawinan'],
            'golongan_darah' => '',
            'nomor_telepon' => '',
            'hubungan_keluarga' => $hubunganLabel,
            'status_penduduk' => 'aktif',
        ]);

        return redirect()->route('keluarga.show', $keluarga)->with('success', 'Anggota keluarga berhasil ditambahkan.');
    }

    public function edit(KartuKeluarga $keluarga): View
    {
        $keluarga->load('kepalaKeluarga');
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, KartuKeluarga $keluarga)
    {
        $data = $request->validate([
            'nomor_kk' => 'required|string|max:16|unique:kartu_keluarga,nomor_kk,' . $keluarga->id,
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kode_pos' => 'nullable|string|max:10',
            'alamat' => 'required|string',
            'kk_nomor_telepon' => 'nullable|string|max:20',
        ]);

        $keluarga->update($data);

        return redirect()->route('keluarga.show', $keluarga)->with('success', 'Data keluarga berhasil diperbarui.');
    }

    public function updateAnggota(Request $request, KartuKeluarga $keluarga, Penduduk $penduduk)
    {
        $data = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik,' . $penduduk->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama_id' => 'required|exists:agama,id',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'required|string',
            'golongan_darah' => 'nullable|string|max:5',
            'nomor_telepon' => 'nullable|string|max:20',
            'hubungan_keluarga' => 'nullable|string',
        ]);

        $penduduk->update($data);

        return redirect()->route('keluarga.show', $keluarga)->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroyAnggota(KartuKeluarga $keluarga, Penduduk $penduduk)
    {
        if ($penduduk->hubungan_keluarga === 'kepala_keluarga') {
            return back()->with('error', 'Kepala keluarga tidak bisa dihapus.');
        }
        $penduduk->delete();
        return redirect()->route('keluarga.show', $keluarga)->with('success', 'Anggota berhasil dihapus dari keluarga.');
    }

    public function destroy(KartuKeluarga $keluarga)
    {
        $keluarga->anggotaKeluarga()->delete();
        $keluarga->delete();

        return redirect()->route('keluarga.index')->with('success', 'Keluarga berhasil dihapus.');
    }
}
