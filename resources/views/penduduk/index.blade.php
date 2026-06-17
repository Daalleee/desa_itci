@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIK atau nama..."
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-64">
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Cari</button>
                @if ($search)
                    <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Reset</a>
                @endif
            </form>
            <button onclick="openModal('modal-create')" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">+ Tambah</button>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-medium text-gray-600">NIK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Nama</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">JK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">KK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">RT/RW</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Status</th>
                        <th class="text-right py-3 px-2 font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penduduk as $p)
                        @php $editData = json_encode($p->only(['id', 'nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama_id', 'pendidikan', 'pekerjaan', 'status_perkawinan', 'golongan_darah', 'nomor_telepon', 'kartu_keluarga_id', 'hubungan_keluarga', 'status_penduduk'])); @endphp
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-2">{{ $p->nik }}</td>
                            <td class="py-3 px-2">
                                <a href="{{ route('penduduk.show', $p) }}" class="text-green-700 hover:underline font-medium">{{ $p->nama_lengkap }}</a>
                            </td>
                            <td class="py-3 px-2">{{ $p->jenis_kelamin }}</td>
                            <td class="py-3 px-2">{{ $p->kartuKeluarga?->nomor_kk ?? '-' }}</td>
                            <td class="py-3 px-2">{{ $p->kartuKeluarga?->rt }}/{{ $p->kartuKeluarga?->rw }}</td>
                            <td class="py-3 px-2">
                                <span class="px-2 py-0.5 text-xs rounded-full {{ $p->status_penduduk === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $p->status_penduduk }}
                                </span>
                            </td>
                            <td class="py-3 px-2 text-right">
                                <button type="button" onclick='openEditModal(this)'
                                    data-json='{!! $editData !!}'
                                    data-update-url="{{ route('penduduk.update', $p) }}"
                                    class="text-blue-600 hover:underline text-xs">Edit</button>
                                <button onclick="confirmDelete('{{ route('penduduk.destroy', $p) }}')" class="text-red-600 hover:underline text-xs ml-2">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-6 text-center text-gray-500">Belum ada data penduduk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $penduduk->links() }}</div>
    </div>

    @push('modals')
    <x-modal id="modal-create" title="Tambah Penduduk / Keluarga">
        <form method="POST" action="{{ route('penduduk.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                <label class="block text-sm font-semibold text-green-800 mb-2">Peran dalam Keluarga</label>
                <div class="flex gap-3">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="_peran" value="kepala_keluarga" onchange="togglePeran(this.value)" {{ old('_peran') === 'kepala_keluarga' ? 'checked' : '' }}>
                        <span class="block text-center text-sm px-2 py-1.5 rounded border {{ old('_peran', 'kepala_keluarga') === 'kepala_keluarga' ? 'bg-green-600 text-white border-green-600' : 'bg-white border-gray-300' }}" id="label-kepala_keluarga">Kepala Keluarga</span>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="_peran" value="istri" onchange="togglePeran(this.value)" {{ old('_peran') === 'istri' ? 'checked' : '' }}>
                        <span class="block text-center text-sm px-2 py-1.5 rounded border {{ old('_peran') === 'istri' ? 'bg-green-600 text-white border-green-600' : 'bg-white border-gray-300' }}" id="label-istri">Istri</span>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="_peran" value="anak" onchange="togglePeran(this.value)" {{ old('_peran') === 'anak' ? 'checked' : '' }}>
                        <span class="block text-center text-sm px-2 py-1.5 rounded border {{ old('_peran') === 'anak' ? 'bg-green-600 text-white border-green-600' : 'bg-white border-gray-300' }}" id="label-anak">Anak</span>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="_peran" value="kerabat" onchange="togglePeran(this.value)" {{ old('_peran') === 'kerabat' ? 'checked' : '' }}>
                        <span class="block text-center text-sm px-2 py-1.5 rounded border {{ old('_peran') === 'kerabat' ? 'bg-green-600 text-white border-green-600' : 'bg-white border-gray-300' }}" id="label-kerabat">Kerabat</span>
                    </label>
                </div>
            </div>

            <div id="kk-baru-section" class="bg-blue-50 border border-blue-200 rounded-lg p-3 {{ old('_peran', 'kepala_keluarga') === 'kepala_keluarga' ? '' : 'hidden' }}">
                <p class="text-sm font-semibold text-blue-800 mb-2">Data Kartu Keluarga Baru</p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nomor KK <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_kk_baru" value="{{ old('nomor_kk_baru') }}" maxlength="20"
                            placeholder="Contoh: 7208010101010001"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('nomor_kk_baru') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt_baru" value="{{ old('rt_baru') }}" maxlength="5"
                            placeholder="Contoh: 01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw_baru" value="{{ old('rw_baru') }}" maxlength="5"
                            placeholder="Contoh: 01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat_baru" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('alamat_baru') }}</textarea>
                    </div>
                </div>
            </div>

            <div id="kk-existing-section" class="bg-gray-50 border border-gray-200 rounded-lg p-3 {{ old('_peran', 'kepala_keluarga') === 'kepala_keluarga' ? 'hidden' : '' }}">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Kartu Keluarga</label>
                <select name="kartu_keluarga_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Belum punya KK --</option>
                    @foreach ($kartuKeluarga as $kk)
                        <option value="{{ $kk->id }}" @selected(old('kartu_keluarga_id') == $kk->id)>{{ $kk->nomor_kk }} - {{ $kk->kepalaKeluarga?->nama_lengkap ?? '(tanpa kepala)' }} (RT {{ $kk->rt }}/RW {{ $kk->rw }})</option>
                    @endforeach
                </select>
            </div>

            <div class="border-t border-gray-200 pt-3">
                <p class="text-sm font-semibold text-gray-800 mb-2">Data Pribadi</p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                            placeholder="16 digit angka"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('nik') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                            placeholder="Contoh: JOHN DOE"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                            placeholder="Contoh: PENAJAM"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" id="create-jenis_kelamin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                            <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                        <select name="agama_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            @foreach ($agama as $a)<option value="{{ $a->id }}" @selected(old('agama_id') == $a->id)>{{ $a->nama_agama }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Pendidikan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="pendidikan" value="{{ old('pendidikan') }}"
                            placeholder="Contoh: SMA, D3, S1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Pekerjaan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                            placeholder="Contoh: Petani, PNS, Wiraswasta"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                        <select name="status_perkawinan" id="create-status_perkawinan" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            <option value="belum_kawin" @selected(old('status_perkawinan') == 'belum_kawin')>Belum Kawin</option>
                            <option value="kawin" @selected(old('status_perkawinan') == 'kawin')>Kawin</option>
                            <option value="cerai_hidup" @selected(old('status_perkawinan') == 'cerai_hidup')>Cerai Hidup</option>
                            <option value="cerai_mati" @selected(old('status_perkawinan') == 'cerai_mati')>Cerai Mati</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Golongan Darah <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <select name="golongan_darah" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih --</option>
                            @foreach (['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)<option value="{{ $g }}" @selected(old('golongan_darah') == $g)>{{ $g }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">No. Telepon <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                            placeholder="Contoh: 081234567890"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Foto <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="file" name="foto" accept="image/*" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-gray-200">
                <button type="button" onclick="closeModal('modal-create')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </x-modal>

    <x-modal id="modal-edit" title="Edit Penduduk">
        <form id="edit-form" method="POST" action="" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="edit-nik" value="{{ old('nik') }}" required maxlength="16"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('nik') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" id="edit-nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" id="edit-tempat_lahir" value="{{ old('tempat_lahir') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" id="edit-tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" id="edit-jenis_kelamin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option><option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option><option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                    <select name="agama_id" id="edit-agama_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($agama as $a)<option value="{{ $a->id }}" @selected(old('agama_id') == $a->id)>{{ $a->nama_agama }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="pendidikan" id="edit-pendidikan" value="{{ old('pendidikan') }}"
                        placeholder="Contoh: SMA, D3, S1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="pekerjaan" id="edit-pekerjaan" value="{{ old('pekerjaan') }}"
                        placeholder="Contoh: Petani, PNS, Wiraswasta"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                    <select name="status_perkawinan" id="edit-status_perkawinan" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="belum_kawin" @selected(old('status_perkawinan') == 'belum_kawin')>Belum Kawin</option><option value="kawin" @selected(old('status_perkawinan') == 'kawin')>Kawin</option>
                        <option value="cerai_hidup" @selected(old('status_perkawinan') == 'cerai_hidup')>Cerai Hidup</option><option value="cerai_mati" @selected(old('status_perkawinan') == 'cerai_mati')>Cerai Mati</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <select name="golongan_darah" id="edit-golongan_darah" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach (['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)<option value="{{ $g }}" @selected(old('golongan_darah') == $g)>{{ $g }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="nomor_telepon" id="edit-nomor_telepon" value="{{ old('nomor_telepon') }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor KK <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <select name="kartu_keluarga_id" id="edit-kartu_keluarga_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Belum punya KK --</option>
                        @foreach ($kartuKeluarga as $kk)<option value="{{ $kk->id }}" @selected(old('kartu_keluarga_id') == $kk->id)>{{ $kk->nomor_kk }} - {{ $kk->kepalaKeluarga?->nama_lengkap ?? '(tanpa kepala)' }} (RT {{ $kk->rt }}/RW {{ $kk->rw }})</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan Keluarga <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="hubungan_keluarga" id="edit-hubungan_keluarga" value="{{ old('hubungan_keluarga') }}"
                        placeholder="Contoh: Istri, Anak, Kepala Keluarga"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeModal('modal-edit')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </x-modal>

    <x-modal id="modal-delete" title="Konfirmasi Hapus">
        <p class="text-sm text-gray-600 mb-2">Apakah Anda yakin ingin menghapus data ini?</p>
        <p class="text-xs text-red-600">Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end gap-2 pt-4 border-t border-gray-200 mt-4">
            <button type="button" onclick="closeModal('modal-delete')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
            <form id="delete-form" method="POST" action="">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </x-modal>
    @endpush
@endsection

@push('scripts')
<script>
    function togglePeran(val) {
        var labels = ['kepala_keluarga', 'istri', 'anak', 'kerabat'];
        labels.forEach(function(r) {
            document.getElementById('label-' + r).className = 'block text-center text-sm px-2 py-1.5 rounded border ' + (r === val ? 'bg-green-600 text-white border-green-600' : 'bg-white border-gray-300');
        });
        document.getElementById('kk-baru-section').className = 'bg-blue-50 border border-blue-200 rounded-lg p-3 ' + (val === 'kepala_keluarga' ? '' : 'hidden');
        document.getElementById('kk-existing-section').className = 'bg-gray-50 border border-gray-200 rounded-lg p-3 ' + (val === 'kepala_keluarga' ? 'hidden' : '');
        if (val === 'kepala_keluarga' && !document.getElementById('create-jenis_kelamin').value) document.getElementById('create-jenis_kelamin').value = 'L';
        if (val === 'istri' && !document.getElementById('create-jenis_kelamin').value) document.getElementById('create-jenis_kelamin').value = 'P';
        if ((val === 'kepala_keluarga' || val === 'istri') && !document.getElementById('create-status_perkawinan').value) document.getElementById('create-status_perkawinan').value = 'kawin';
        if (val === 'anak' && !document.getElementById('create-status_perkawinan').value) document.getElementById('create-status_perkawinan').value = 'belum_kawin';
    }

    function confirmDelete(url) {
        document.getElementById('delete-form').action = url;
        openModal('modal-delete');
    }

    function openEditModal(btn) {
        var d = JSON.parse(btn.getAttribute('data-json'));
        document.getElementById('edit-form').action = btn.getAttribute('data-update-url');
        document.getElementById('edit-nik').value = d.nik;
        document.getElementById('edit-nama_lengkap').value = d.nama_lengkap;
        document.getElementById('edit-tempat_lahir').value = d.tempat_lahir;
        document.getElementById('edit-tanggal_lahir').value = d.tanggal_lahir ? d.tanggal_lahir.substring(0, 10) : '';
        document.getElementById('edit-jenis_kelamin').value = d.jenis_kelamin;
        document.getElementById('edit-agama_id').value = d.agama_id;
        document.getElementById('edit-pendidikan').value = d.pendidikan || '';
        document.getElementById('edit-pekerjaan').value = d.pekerjaan || '';
        document.getElementById('edit-status_perkawinan').value = d.status_perkawinan;
        document.getElementById('edit-golongan_darah').value = d.golongan_darah || '';
        document.getElementById('edit-nomor_telepon').value = d.nomor_telepon || '';
        document.getElementById('edit-kartu_keluarga_id').value = d.kartu_keluarga_id;
        document.getElementById('edit-hubungan_keluarga').value = d.hubungan_keluarga;
        openModal('modal-edit');
    }

    @if ($errors->any())
        @if (old('_method') === 'PUT')
        openModal('modal-edit');
        @else
        openModal('modal-create');
        togglePeran('{{ old('_peran', 'kepala_keluarga') }}');
        @endif
    @endif

    setTimeout(function() {
        var alert = document.querySelector('[class*="bg-green-100"][class*="text-green-700"]');
        if (alert) { alert.style.transition = 'opacity 0.5s'; alert.style.opacity = '0'; setTimeout(function() { alert.remove(); }, 500); }
    }, 5000);
</script>
@endpush
