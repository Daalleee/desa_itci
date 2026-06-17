@extends('layouts.admin')

@section('title', 'Edit Keluarga')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Edit Data Keluarga</h3>
            <a href="{{ route('keluarga.show', $keluarga) }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('keluarga.update', $keluarga) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor KK <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_kk" value="{{ old('nomor_kk', $keluarga->nomor_kk) }}" maxlength="16"
                        placeholder="Contoh: 7208010101010001"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('nomor_kk') border-red-400 @enderror">
                    @error('nomor_kk')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RT <span class="text-red-500">*</span></label>
                    <input type="text" name="rt" value="{{ old('rt', $keluarga->rt) }}" maxlength="5"
                        placeholder="Contoh: 01"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('rt') border-red-400 @enderror">
                    @error('rt')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RW <span class="text-red-500">*</span></label>
                    <input type="text" name="rw" value="{{ old('rw', $keluarga->rw) }}" maxlength="5"
                        placeholder="Contoh: 01"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('rw') border-red-400 @enderror">
                    @error('rw')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="kode_pos" value="{{ old('kode_pos', $keluarga->kode_pos) }}" maxlength="10"
                        placeholder="Contoh: 76111"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon KK <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="kk_nomor_telepon" value="{{ old('kk_nomor_telepon', $keluarga->nomor_telepon) }}" maxlength="20"
                        placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2"
                        placeholder="Contoh: Jl. Poros ITCI RT 01"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('alamat') border-red-400 @enderror">{{ old('alamat', $keluarga->alamat) }}</textarea>
                    @error('alamat')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-6 border-t border-gray-200 mt-6">
                <a href="{{ route('keluarga.show', $keluarga) }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-6 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
