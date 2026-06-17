@extends('layouts.admin')

@section('title', 'Tambah Keluarga Baru')

@section('content')
<div class="max-w-3xl mx-auto" x-data="wizardForm()">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Keluarga Baru</h3>
            <a href="{{ route('keluarga.index') }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Kembali</a>
        </div>

        <div class="flex items-center gap-2 mb-6">
            <template x-for="(step, idx) in steps" :key="idx">
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1.5">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-medium"
                            :class="stepIndex > idx ? 'bg-green-600 text-white' : (stepIndex === idx ? 'bg-green-700 text-white' : 'bg-gray-200 text-gray-500')"
                            x-text="idx + 1"></span>
                        <span class="text-xs font-medium"
                            :class="stepIndex >= idx ? 'text-green-700' : 'text-gray-400'"
                            x-text="step.label"></span>
                    </div>
                    <template x-if="idx < steps.length - 1">
                        <span class="w-8 h-0.5" :class="stepIndex > idx ? 'bg-green-600' : 'bg-gray-200'"></span>
                    </template>
                </div>
            </template>
        </div>

        @if ($errors->any())
            <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg text-sm">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('keluarga.store') }}">
            @csrf

            {{-- STEP 1: Informasi Keluarga --}}
            <div x-show="stepIndex === 0" class="space-y-4">
                <h4 class="text-md font-semibold text-gray-700 border-b pb-2">Informasi Keluarga</h4>
                <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor KK <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_kk" x-model="form.nomor_kk" maxlength="16"
                            placeholder="Contoh: 7208010101010001"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.nomor_kk ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.nomor_kk"><p class="text-xs text-red-600 mt-1" x-text="errors.nomor_kk"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt" x-model="form.rt" maxlength="5"
                            placeholder="Contoh: 01"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.rt ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.rt"><p class="text-xs text-red-600 mt-1" x-text="errors.rt"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw" x-model="form.rw" maxlength="5"
                            placeholder="Contoh: 01"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.rw ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.rw"><p class="text-xs text-red-600 mt-1" x-text="errors.rw"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="kode_pos" x-model="form.kode_pos" maxlength="10"
                            placeholder="Contoh: 76111"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.kode_pos ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.kode_pos"><p class="text-xs text-red-600 mt-1" x-text="errors.kode_pos"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon KK <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="kk_nomor_telepon" x-model="form.kk_nomor_telepon" maxlength="20"
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.kk_nomor_telepon ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.kk_nomor_telepon"><p class="text-xs text-red-600 mt-1" x-text="errors.kk_nomor_telepon"></p></template>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" x-model="form.alamat" rows="2"
                            placeholder="Contoh: Jl. Poros ITCI RT 01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.alamat ? 'border-red-400 ring-2 ring-red-200' : ''"></textarea>
                        <template x-if="errors.alamat"><p class="text-xs text-red-600 mt-1" x-text="errors.alamat"></p></template>
                    </div>
                </div>
            </div>

            {{-- STEP 2: Kepala Keluarga --}}
            <div x-show="stepIndex === 1" class="space-y-4">
                <h4 class="text-md font-semibold text-gray-700 border-b pb-2">Kepala Keluarga</h4>
                <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" x-model="form.nik" maxlength="16"
                            placeholder="16 digit angka"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.nik ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.nik"><p class="text-xs text-red-600 mt-1" x-text="errors.nik"></p></template>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" x-model="form.nama_lengkap"
                            placeholder="Contoh: JOHN DOE"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.nama_lengkap ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.nama_lengkap"><p class="text-xs text-red-600 mt-1" x-text="errors.nama_lengkap"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" x-model="form.tempat_lahir"
                            placeholder="Contoh: PENAJAM"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.tempat_lahir ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.tempat_lahir"><p class="text-xs text-red-600 mt-1" x-text="errors.tempat_lahir"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" x-model="form.tanggal_lahir"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.tanggal_lahir ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.tanggal_lahir"><p class="text-xs text-red-600 mt-1" x-text="errors.tanggal_lahir"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" x-model="form.jenis_kelamin"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.jenis_kelamin ? 'border-red-400 ring-2 ring-red-200' : ''">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <template x-if="errors.jenis_kelamin"><p class="text-xs text-red-600 mt-1" x-text="errors.jenis_kelamin"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
                        <select name="agama_id" x-model="form.agama_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.agama_id ? 'border-red-400 ring-2 ring-red-200' : ''">
                            <option value="">-- Pilih --</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->id }}">{{ $a->nama_agama }}</option>
                            @endforeach
                        </select>
                        <template x-if="errors.agama_id"><p class="text-xs text-red-600 mt-1" x-text="errors.agama_id"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="pendidikan" x-model="form.pendidikan"
                            placeholder="Contoh: SMA, D3, S1"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="pekerjaan" x-model="form.pekerjaan"
                            placeholder="Contoh: Petani, PNS, Wiraswasta"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                        <select name="status_perkawinan" x-model="form.status_perkawinan"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.status_perkawinan ? 'border-red-400 ring-2 ring-red-200' : ''">
                            <option value="">-- Pilih --</option>
                            <option value="belum_kawin">Belum Kawin</option>
                            <option value="kawin">Kawin</option>
                            <option value="cerai_hidup">Cerai Hidup</option>
                            <option value="cerai_mati">Cerai Mati</option>
                        </select>
                        <template x-if="errors.status_perkawinan"><p class="text-xs text-red-600 mt-1" x-text="errors.status_perkawinan"></p></template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Golongan Darah <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <select name="golongan_darah" x-model="form.golongan_darah"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            @foreach (['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="nik_nomor_telepon" x-model="form.nik_nomor_telepon" maxlength="20"
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            :class="errors.nik_nomor_telepon ? 'border-red-400 ring-2 ring-red-200' : ''">
                        <template x-if="errors.nik_nomor_telepon"><p class="text-xs text-red-600 mt-1" x-text="errors.nik_nomor_telepon"></p></template>
                    </div>
                </div>
            </div>

            {{-- STEP 3: Anggota Keluarga --}}
            <div x-show="stepIndex === 2" class="space-y-4">
                <h4 class="text-md font-semibold text-gray-700 border-b pb-2">Anggota Keluarga</h4>
                <p class="text-xs text-gray-500">Isi data anggota keluarga (jika ada). Kosongkan jika belum ada anggota lain.</p>

                <template x-for="(a, idx) in anggota" :key="idx">
                    <div class="border border-gray-200 rounded-lg p-4 space-y-3 relative">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600" x-text="'Anggota ' + (idx + 1)"></span>
                            <button type="button" @click="hapusAnggota(idx)" class="text-red-500 hover:text-red-700 text-xs">&times; Hapus</button>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                                <input type="text" :name="'anggota[' + idx + '][nik]'"
                                    x-model="a.nik" required maxlength="16"
                                    placeholder="16 digit angka"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" :name="'anggota[' + idx + '][nama_lengkap]'"
                                    x-model="a.nama_lengkap" required
                                    placeholder="Contoh: JOHN DOE"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" :name="'anggota[' + idx + '][tempat_lahir]'"
                                    x-model="a.tempat_lahir" required
                                    placeholder="Contoh: PENAJAM"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" :name="'anggota[' + idx + '][tanggal_lahir]'"
                                    x-model="a.tanggal_lahir" required
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][jenis_kelamin]'" x-model="a.jenis_kelamin" required
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][agama_id]'" x-model="a.agama_id" required
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($agama as $ag)
                                        <option value="{{ $ag->id }}">{{ $ag->nama_agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Pendidikan <span class="text-gray-400 font-normal">(opsional)</span></label>
                                <input type="text" :name="'anggota[' + idx + '][pendidikan]'"
                                    x-model="a.pendidikan"
                                    placeholder="Contoh: SMA, D3, S1"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Pekerjaan <span class="text-gray-400 font-normal">(opsional)</span></label>
                                <input type="text" :name="'anggota[' + idx + '][pekerjaan]'"
                                    x-model="a.pekerjaan"
                                    placeholder="Contoh: Petani, PNS, Wiraswasta"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][status_perkawinan]'" x-model="a.status_perkawinan" required
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="belum_kawin">Belum Kawin</option>
                                    <option value="kawin">Kawin</option>
                                    <option value="cerai_hidup">Cerai Hidup</option>
                                    <option value="cerai_mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Keluarga <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][hubungan_keluarga]'" x-model="a.hubungan_keluarga" required
                                    @change="onHubunganChange(idx)"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="istri">Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="orang_tua">Orang Tua</option>
                                    <option value="kerabat">Kerabat</option>
                                </select>
                            </div>

                            <div x-show="a.hubungan_keluarga === 'anak'" class="col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">Status Anak <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][status_anak]'" x-model="a.status_anak"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="anak_kandung">Anak Kandung</option>
                                    <option value="anak_angkat">Anak Angkat</option>
                                    <option value="anak_tiri">Anak Tiri</option>
                                </select>
                            </div>

                            <div x-show="a.hubungan_keluarga === 'orang_tua'" class="col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Orang Tua <span class="text-red-500">*</span></label>
                                <select :name="'anggota[' + idx + '][hubungan_orang_tua]'" x-model="a.hubungan_orang_tua"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="ayah">Ayah</option>
                                    <option value="ibu">Ibu</option>
                                    <option value="mertua">Mertua</option>
                                </select>
                            </div>

                            <div x-show="a.hubungan_keluarga === 'kerabat'" class="col-span-2 space-y-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Kerabat <span class="text-red-500">*</span></label>
                                    <select :name="'anggota[' + idx + '][hubungan_kerabat]'" x-model="a.hubungan_kerabat"
                                        class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <option value="">-- Pilih --</option>
                                        <option value="paman">Paman</option>
                                        <option value="bibi">Bibi</option>
                                        <option value="sepupu">Sepupu</option>
                                        <option value="keponakan">Keponakan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div x-show="a.hubungan_kerabat === 'lainnya'">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Hubungan Kerabat Lainnya</label>
                                    <input type="text" :name="'anggota[' + idx + '][hubungan_kerabat_lainnya]'"
                                        x-model="a.hubungan_kerabat_lainnya"
                                        placeholder="Tulis hubungan kerabat"
                                        class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <button type="button" @click="tambahAnggota"
                    class="w-full py-3 border-2 border-dashed border-gray-300 rounded-lg text-sm text-gray-500 hover:border-green-500 hover:text-green-600 transition">
                    + Tambah Anggota
                </button>
            </div>

            <div class="flex justify-between pt-6 border-t border-gray-200 mt-6">
                <button type="button" x-show="stepIndex > 0" @click="prevStep"
                    class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Sebelumnya</button>
                <div></div>
                <button type="button" x-show="stepIndex < steps.length - 1" @click="nextStep"
                    class="px-6 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Selanjutnya</button>
                <button type="submit" x-show="stepIndex === steps.length - 1"
                    class="px-6 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan Keluarga</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function wizardForm() {
        return {
            stepIndex: 0,
            steps: [
                { label: 'Info Keluarga' },
                { label: 'Kepala Keluarga' },
                { label: 'Anggota Keluarga' },
            ],
            form: {
                nomor_kk: '',
                rt: '',
                rw: '',
                kode_pos: '',
                alamat: '',
                kk_nomor_telepon: '',
                nik: '',
                nama_lengkap: '',
                tempat_lahir: '',
                tanggal_lahir: '',
                jenis_kelamin: '',
                agama_id: '',
                pendidikan: '',
                pekerjaan: '',
                status_perkawinan: '',
                golongan_darah: '',
                nik_nomor_telepon: '',
            },
            errors: {},
            anggota: [],
            tambahAnggota() {
                this.anggota.push({
                    nik: '',
                    nama_lengkap: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    jenis_kelamin: '',
                    agama_id: '',
                    pendidikan: '',
                    pekerjaan: '',
                    status_perkawinan: '',
                    hubungan_keluarga: '',
                    status_anak: '',
                    hubungan_orang_tua: '',
                    hubungan_kerabat: '',
                    hubungan_kerabat_lainnya: '',
                });
            },
            hapusAnggota(idx) {
                this.anggota.splice(idx, 1);
            },
            onHubunganChange(idx) {
                var a = this.anggota[idx];
                a.status_anak = '';
                a.hubungan_orang_tua = '';
                a.hubungan_kerabat = '';
                a.hubungan_kerabat_lainnya = '';
            },
            validateStep() {
                this.errors = {};
                var valid = true;

                if (this.stepIndex === 0) {
                    var nomorKK = this.form.nomor_kk.trim();
                    if (!nomorKK) { this.errors.nomor_kk = 'Nomor KK wajib diisi.'; valid = false; }
                    else if (!/^\d{16}$/.test(nomorKK)) { this.errors.nomor_kk = 'Nomor KK harus 16 digit angka.'; valid = false; }

                    var rt = this.form.rt.trim();
                    if (!rt) { this.errors.rt = 'RT wajib diisi.'; valid = false; }
                    else if (!/^\d+$/.test(rt)) { this.errors.rt = 'RT hanya boleh angka.'; valid = false; }

                    var rw = this.form.rw.trim();
                    if (!rw) { this.errors.rw = 'RW wajib diisi.'; valid = false; }
                    else if (!/^\d+$/.test(rw)) { this.errors.rw = 'RW hanya boleh angka.'; valid = false; }

                    if (!this.form.alamat.trim()) { this.errors.alamat = 'Alamat wajib diisi.'; valid = false; }

                    var kodePos = this.form.kode_pos.trim();
                    if (kodePos && !/^\d{5}$/.test(kodePos)) { this.errors.kode_pos = 'Kode Pos harus 5 digit angka.'; valid = false; }

                    var telp = this.form.kk_nomor_telepon.trim();
                    if (telp && !/^\d+$/.test(telp)) { this.errors.kk_nomor_telepon = 'Nomor telepon hanya boleh angka.'; valid = false; }
                }

                if (this.stepIndex === 1) {
                    var nik = this.form.nik.trim();
                    if (!nik) { this.errors.nik = 'NIK wajib diisi.'; valid = false; }
                    else if (!/^\d{16}$/.test(nik)) { this.errors.nik = 'NIK harus 16 digit angka.'; valid = false; }

                    if (!this.form.nama_lengkap.trim()) { this.errors.nama_lengkap = 'Nama lengkap wajib diisi.'; valid = false; }
                    if (!this.form.tempat_lahir.trim()) { this.errors.tempat_lahir = 'Tempat lahir wajib diisi.'; valid = false; }
                    if (!this.form.tanggal_lahir) { this.errors.tanggal_lahir = 'Tanggal lahir wajib diisi.'; valid = false; }
                    if (!this.form.jenis_kelamin) { this.errors.jenis_kelamin = 'Pilih jenis kelamin.'; valid = false; }
                    if (!this.form.agama_id) { this.errors.agama_id = 'Pilih agama.'; valid = false; }
                    if (!this.form.status_perkawinan) { this.errors.status_perkawinan = 'Pilih status perkawinan.'; valid = false; }

                    var telp = this.form.nik_nomor_telepon.trim();
                    if (telp && !/^\d+$/.test(telp)) { this.errors.nik_nomor_telepon = 'Nomor telepon hanya boleh angka.'; valid = false; }
                }

                return valid;
            },
            nextStep() {
                if (this.validateStep()) {
                    if (this.stepIndex < this.steps.length - 1) this.stepIndex++;
                }
            },
            prevStep() {
                if (this.stepIndex > 0) this.stepIndex--;
            },
        };
    }
</script>
@endpush
