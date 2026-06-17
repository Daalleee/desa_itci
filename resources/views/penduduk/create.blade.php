@extends('layouts.admin')

@section('title', 'Tambah Penduduk')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl">
        <form method="POST" action="{{ route('penduduk.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK *</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('nik') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('nama_lengkap') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('tempat_lahir') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('tanggal_lahir') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                        <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama *</label>
                    <select name="agama_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($agama as $a)
                            <option value="{{ $a->id }}" @selected(old('agama_id') == $a->id)>{{ $a->nama_agama }}</option>
                        @endforeach
                    </select>
                    @error('agama_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan *</label>
                    <select name="pendidikan_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($pendidikan as $p)
                            <option value="{{ $p->id }}" @selected(old('pendidikan_id') == $p->id)>{{ $p->nama_pendidikan }}</option>
                        @endforeach
                    </select>
                    @error('pendidikan_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan *</label>
                    <select name="pekerjaan_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($pekerjaan as $p)
                            <option value="{{ $p->id }}" @selected(old('pekerjaan_id') == $p->id)>{{ $p->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                    @error('pekerjaan_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan *</label>
                    <select name="status_perkawinan" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="belum_kawin" @selected(old('status_perkawinan') == 'belum_kawin')>Belum Kawin</option>
                        <option value="kawin" @selected(old('status_perkawinan') == 'kawin')>Kawin</option>
                        <option value="cerai_hidup" @selected(old('status_perkawinan') == 'cerai_hidup')>Cerai Hidup</option>
                        <option value="cerai_mati" @selected(old('status_perkawinan') == 'cerai_mati')>Cerai Mati</option>
                    </select>
                    @error('status_perkawinan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                    <select name="golongan_darah"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach (['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $g)
                            <option value="{{ $g }}" @selected(old('golongan_darah') == $g)>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor KK *</label>
                    <select name="kartu_keluarga_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($kartuKeluarga as $kk)
                            <option value="{{ $kk->id }}" @selected(old('kartu_keluarga_id') == $kk->id)>
                                {{ $kk->nomor_kk }} - {{ $kk->rt }}/{{ $kk->rw }}
                            </option>
                        @endforeach
                    </select>
                    @error('kartu_keluarga_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan Keluarga *</label>
                    <select name="hubungan_keluarga" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="kepala_keluarga" @selected(old('hubungan_keluarga') == 'kepala_keluarga')>Kepala Keluarga</option>
                        <option value="istri" @selected(old('hubungan_keluarga') == 'istri')>Istri</option>
                        <option value="anak" @selected(old('hubungan_keluarga') == 'anak')>Anak</option>
                        <option value="orang_tua" @selected(old('hubungan_keluarga') == 'orang_tua')>Orang Tua</option>
                        <option value="kerabat" @selected(old('hubungan_keluarga') == 'kerabat')>Kerabat</option>
                    </select>
                    @error('hubungan_keluarga') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </div>
@endsection
