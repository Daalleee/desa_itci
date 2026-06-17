@extends('layouts.admin')

@section('title', 'Catat Mutasi')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl">
        <form method="POST" action="{{ route('mutasi.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penduduk *</label>
                    <select name="penduduk_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($penduduk as $p)
                            <option value="{{ $p->id }}" @selected(old('penduduk_id') == $p->id)>{{ $p->nik }} - {{ $p->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('penduduk_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Mutasi *</label>
                    <select name="jenis_mutasi" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="masuk" @selected(old('jenis_mutasi') == 'masuk')>Penduduk Masuk</option>
                        <option value="keluar" @selected(old('jenis_mutasi') == 'keluar')>Penduduk Keluar</option>
                        <option value="meninggal" @selected(old('jenis_mutasi') == 'meninggal')>Penduduk Meninggal</option>
                    </select>
                    @error('jenis_mutasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mutasi *</label>
                    <input type="date" name="tanggal_mutasi" value="{{ old('tanggal_mutasi') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('tanggal_mutasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal / Tujuan *</label>
                    <input type="text" name="asal_tujuan" value="{{ old('asal_tujuan') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('asal_tujuan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan *</label>
                    <input type="text" name="alasan" value="{{ old('alasan') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('alasan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <a href="{{ route('mutasi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </div>
@endsection
