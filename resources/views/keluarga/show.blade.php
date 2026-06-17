@extends('layouts.admin')

@section('title', 'Detail Keluarga')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Kartu Info Keluarga --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center justify-between">
            <div>
                <p class="text-green-100 text-xs font-medium uppercase tracking-wider">Kartu Keluarga</p>
                <h3 class="text-white text-xl font-bold mt-1 tracking-wider">{{ $keluarga->nomor_kk }}</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('keluarga.edit', $keluarga) }}"
                    class="px-3 py-1.5 bg-white/20 text-white text-sm rounded-lg hover:bg-white/30 transition">Edit KK</a>
                <button onclick="openModal('modal-tambah-anggota')"
                    class="px-3 py-1.5 bg-white text-green-700 text-sm font-medium rounded-lg hover:bg-green-50 transition">+ Anggota</button>
            </div>
        </div>

        <div class="px-6 py-4">
            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $keluarga->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($keluarga->status) }}
                </span>
                <span class="text-xs text-gray-400">{{ $keluarga->anggotaKeluarga->count() }} anggota</span>
            </div>

            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Alamat</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $keluarga->alamat }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">RT / RW</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $keluarga->rt }} / {{ $keluarga->rw }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Kode Pos</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $keluarga->kode_pos ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Telepon</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $keluarga->nomor_telepon ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Anggota Keluarga --}}
    @php
        $groupOrder = ['kepala_keluarga', 'istri', 'anak', 'ayah', 'ibu', 'mertua', 'paman', 'bibi', 'sepupu', 'keponakan', 'kerabat'];
        $groupLabels = [
            'kepala_keluarga' => 'Kepala Keluarga', 'istri' => 'Istri',
            'anak' => 'Anak',
            'ayah' => 'Ayah', 'ibu' => 'Ibu', 'mertua' => 'Mertua',
            'paman' => 'Paman', 'bibi' => 'Bibi', 'sepupu' => 'Sepupu', 'keponakan' => 'Keponakan', 'kerabat' => 'Kerabat',
        ];
        $groupColors = [
            'kepala_keluarga' => 'border-l-blue-500',
            'istri' => 'border-l-pink-500',
            'anak' => 'border-l-emerald-500',
            'ayah' => 'border-l-amber-500',
            'ibu' => 'border-l-amber-500',
            'mertua' => 'border-l-amber-500',
            'paman' => 'border-l-purple-500',
            'bibi' => 'border-l-purple-500',
            'sepupu' => 'border-l-purple-500',
            'keponakan' => 'border-l-purple-500',
            'kerabat' => 'border-l-purple-500',
        ];
        $anakKeys = ['anak_kandung', 'anak_angkat', 'anak_tiri'];
        $anggotaGrouped['anak'] = collect();
        foreach ($anakKeys as $ak) {
            if (isset($anggotaGrouped[$ak])) {
                $anggotaGrouped['anak'] = $anggotaGrouped['anak']->merge($anggotaGrouped[$ak]);
            }
        }
        $anggotaGrouped['anak'] = $anggotaGrouped['anak']->sortBy(fn($a) => $a->tanggal_lahir?->timestamp ?? 0)->values();
    @endphp

    @foreach ($groupOrder as $key)
        @if (isset($anggotaGrouped[$key]))
            @php
                $anggotaList = $anggotaGrouped[$key];
                $isAnakGroup = $key === 'anak';
            @endphp
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-4">
                <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full {{ str_replace('border-l-', 'bg-', $groupColors[$key]) }}"></span>
                        <span class="text-sm font-semibold text-gray-800">{{ $groupLabels[$key] ?? ucfirst($key) }}</span>
                        @if (!in_array($key, ['kepala_keluarga', 'istri']))
                            <span class="text-xs text-gray-400">({{ $anggotaList->count() }})</span>
                        @endif
                    </div>
                </div>
                <div class="divide-y divide-gray-50">
                    @foreach ($anggotaList as $index => $anggota)
                        @php
                            $anakLabel = $isAnakGroup ? 'Anak ' . ['Pertama', 'Kedua', 'Ketiga', 'Keempat', 'Kelima', 'Keenam', 'Ketujuh', 'Kedelapan', 'Kesembilan', 'Kesepuluh'][$index] ?? 'Anak ' . ($index + 1) : '';
                        @endphp
                        <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50/50 transition"
                            data-anggota-id="{{ $anggota->id }}"
                            data-nik="{{ $anggota->nik }}"
                            data-nama="{{ $anggota->nama_lengkap }}"
                            data-tempat="{{ $anggota->tempat_lahir }}"
                            data-tgl="{{ $anggota->tanggal_lahir?->format('Y-m-d') }}"
                            data-kelamin="{{ $anggota->jenis_kelamin }}"
                            data-agama="{{ $anggota->agama_id }}"
                            data-pendidikan="{{ $anggota->pendidikan }}"
                            data-pekerjaan="{{ $anggota->pekerjaan }}"
                            data-status="{{ $anggota->status_perkawinan }}"
                            data-goldar="{{ $anggota->golongan_darah }}"
                            data-telp="{{ $anggota->nomor_telepon }}"
                            data-hubungan="{{ $anggota->hubungan_keluarga }}">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                    <span class="text-xs font-semibold text-gray-500">{{ strtoupper(substr($anggota->nama_lengkap, 0, 1)) }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $anggota->nama_lengkap }}</p>
                                    <p class="text-xs text-gray-400">
                                        @if ($anakLabel)
                                            <span class="font-medium text-emerald-600">{{ $anakLabel }}</span> &middot;
                                        @endif
                                        NIK {{ $anggota->nik }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 shrink-0 ml-4">
                                <span class="text-xs text-gray-400 hidden md:inline">{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir?->format('d/m/Y') }}</span>
                                <div class="flex gap-1.5">
                                    <a href="{{ route('penduduk.show', $anggota) }}"
                                        class="px-2.5 py-1 text-[11px] font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 transition">Lihat</a>
                                    <button type="button" onclick="editAnggota(this.closest('[data-anggota-id]'))"
                                        class="px-2.5 py-1 text-[11px] font-medium text-green-600 bg-green-50 rounded-md hover:bg-green-100 transition">Edit</button>
                                    @if ($anggota->hubungan_keluarga !== 'kepala_keluarga')
                                        <form method="POST" action="{{ route('keluarga.anggota.destroy', ['keluarga' => $keluarga, 'penduduk' => $anggota]) }}"
                                            onsubmit="return confirm('Hapus {{ $anggota->nama_lengkap }}?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-2.5 py-1 text-[11px] font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100 transition">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div class="text-center pb-6">
        <a href="{{ route('keluarga.index') }}" class="inline-block px-5 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg hover:bg-gray-200 transition">
            Kembali ke Daftar Keluarga
        </a>
    </div>
</div>

{{-- Modal Tambah Anggota --}}
<x-modal id="modal-tambah-anggota" title="Tambah Anggota Keluarga">
    <form method="POST" action="{{ route('keluarga.anggota.store', $keluarga) }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
                <select name="agama_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_agama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="pendidikan" value="{{ old('pendidikan') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                <select name="status_perkawinan" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    <option value="belum_kawin">Belum Kawin</option>
                    <option value="kawin">Kawin</option>
                    <option value="cerai_hidup">Cerai Hidup</option>
                    <option value="cerai_mati">Cerai Mati</option>
                </select>
            </div>
            <div class="col-span-2" x-data="{ hubungan: '', hubunganKerabat: '' }">
                <label class="block text-sm font-medium text-gray-700 mb-2">Hubungan Keluarga <span class="text-red-500">*</span></label>
                <select name="hubungan_keluarga" x-model="hubungan" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    <option value="istri">Istri</option>
                    <option value="anak">Anak</option>
                    <option value="orang_tua">Orang Tua</option>
                    <option value="kerabat">Kerabat</option>
                </select>
                <div x-show="hubungan === 'anak'" class="mt-3">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Status Anak <span class="text-red-500">*</span></label>
                    <select name="status_anak" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="anak_kandung">Anak Kandung</option>
                        <option value="anak_angkat">Anak Angkat</option>
                        <option value="anak_tiri">Anak Tiri</option>
                    </select>
                </div>
                <div x-show="hubungan === 'orang_tua'" class="mt-3">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Orang Tua <span class="text-red-500">*</span></label>
                    <select name="hubungan_orang_tua" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="ayah">Ayah</option>
                        <option value="ibu">Ibu</option>
                        <option value="mertua">Mertua</option>
                    </select>
                </div>
                <div x-show="hubungan === 'kerabat'" class="mt-3 space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Kerabat <span class="text-red-500">*</span></label>
                        <select name="hubungan_kerabat" x-model="hubunganKerabat" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            <option value="paman">Paman</option>
                            <option value="bibi">Bibi</option>
                            <option value="sepupu">Sepupu</option>
                            <option value="keponakan">Keponakan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div x-show="hubunganKerabat === 'lainnya'">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Lainnya</label>
                        <input type="text" name="hubungan_kerabat_lainnya" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
            <button type="button" @click="closeModal('modal-tambah-anggota')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
        </div>
    </form>
</x-modal>

{{-- Modal Edit Anggota --}}
<x-modal id="modal-edit-anggota" title="Edit Anggota Keluarga">
    <form method="POST" action="" id="form-edit-anggota" class="space-y-4">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" id="edit-nik" required maxlength="16"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" id="edit-nama_lengkap" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" id="edit-tempat_lahir" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" id="edit-tanggal_lahir" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="edit-jenis_kelamin" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
                <select name="agama_id" id="edit-agama_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_agama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan</label>
                <input type="text" name="pendidikan" id="edit-pendidikan"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="edit-pekerjaan"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                <select name="status_perkawinan" id="edit-status_perkawinan" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    <option value="belum_kawin">Belum Kawin</option>
                    <option value="kawin">Kawin</option>
                    <option value="cerai_hidup">Cerai Hidup</option>
                    <option value="cerai_mati">Cerai Mati</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gol. Darah</label>
                <select name="golongan_darah" id="edit-golongan_darah"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih --</option>
                    @foreach (['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                        <option value="{{ $g }}">{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                <input type="text" name="nomor_telepon" id="edit-nomor_telepon" maxlength="20"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <input type="hidden" name="hubungan_keluarga" id="edit-hubungan_keluarga">
        </div>
        <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
            <button type="button" @click="closeModal('modal-edit-anggota')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
        </div>
    </form>
</x-modal>

<script>
function editAnggota(el) {
    var baseUrl = '{{ url("/keluarga/" . $keluarga->id . "/anggota") }}';
    document.getElementById('form-edit-anggota').action = baseUrl + '/' + el.dataset.anggotaId;
    document.getElementById('edit-nik').value = el.dataset.nik;
    document.getElementById('edit-nama_lengkap').value = el.dataset.nama;
    document.getElementById('edit-tempat_lahir').value = el.dataset.tempat;
    document.getElementById('edit-tanggal_lahir').value = el.dataset.tgl;
    document.getElementById('edit-jenis_kelamin').value = el.dataset.kelamin;
    document.getElementById('edit-agama_id').value = el.dataset.agama;
    document.getElementById('edit-pendidikan').value = el.dataset.pendidikan;
    document.getElementById('edit-pekerjaan').value = el.dataset.pekerjaan;
    document.getElementById('edit-status_perkawinan').value = el.dataset.status;
    document.getElementById('edit-golongan_darah').value = el.dataset.goldar;
    document.getElementById('edit-nomor_telepon').value = el.dataset.telp;
    document.getElementById('edit-hubungan_keluarga').value = el.dataset.hubungan;
    openModal('modal-edit-anggota');
}
</script>
@endsection
