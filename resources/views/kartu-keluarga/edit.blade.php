@extends('layouts.admin')

@section('title', 'Edit KK')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl">
        <form method="POST" action="{{ route('kartu-keluarga.update', $kartuKeluarga) }}" class="space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor KK *</label>
                    <input type="text" name="nomor_kk" value="{{ old('nomor_kk', $kartuKeluarga->nomor_kk) }}" required maxlength="20"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('nomor_kk') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Wilayah (RT/RW) *</label>
                    <select name="wilayah_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @foreach ($wilayah as $w)
                            <option value="{{ $w->id }}" @selected(old('wilayah_id', $kartuKeluarga->wilayah_id) == $w->id)>{{ $w->rt }}/{{ $w->rw }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
                    <textarea name="alamat" rows="2" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('alamat', $kartuKeluarga->alamat) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="kode_pos" value="{{ old('kode_pos', $kartuKeluarga->kode_pos) }}" maxlength="10"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $kartuKeluarga->nomor_telepon) }}" maxlength="20"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <a href="{{ route('kartu-keluarga.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </div>
@endsection
