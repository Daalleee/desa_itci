@extends('layouts.admin')

@section('title', 'Data Kartu Keluarga')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nomor KK..."
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-64">
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Cari</button>
                @if ($search)
                    <a href="{{ route('kartu-keluarga.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Reset</a>
                @endif
            </form>
            <button onclick="openModal('modal-create')" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">+ Tambah KK</button>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-medium text-gray-600">No KK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Kepala Keluarga</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">RT/RW</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Alamat</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Status</th>
                        <th class="text-right py-3 px-2 font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kartuKeluarga as $kk)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <a href="{{ route('kartu-keluarga.show', $kk) }}" class="text-green-700 hover:underline font-medium">{{ $kk->nomor_kk }}</a>
                            </td>
                            <td class="py-3 px-2">{{ $kk->kepalaKeluarga?->nama_lengkap ?? '-' }}</td>
                            <td class="py-3 px-2">{{ $kk->rt }}/{{ $kk->rw }}</td>
                            <td class="py-3 px-2 max-w-xs truncate">{{ $kk->alamat }}</td>
                            <td class="py-3 px-2">
                                <span class="px-2 py-0.5 text-xs rounded-full {{ $kk->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $kk->status }}</span>
                            </td>
                            <td class="py-3 px-2 text-right">
                                <a href="{{ route('kartu-keluarga.edit', $kk) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <button onclick="confirmDelete('{{ route('kartu-keluarga.destroy', $kk) }}')" class="text-red-600 hover:underline text-xs ml-2">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada data KK.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $kartuKeluarga->links() }}</div>
    </div>

    @push('modals')
    <x-modal id="modal-create" title="Tambah Kartu Keluarga">
        <form method="POST" action="{{ route('kartu-keluarga.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="status" value="aktif">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor KK <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_kk" value="{{ old('nomor_kk') }}" required maxlength="20"
                        placeholder="Contoh: 7208010101010001"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('nomor_kk') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RT <span class="text-red-500">*</span></label>
                    <input type="text" name="rt" value="{{ old('rt') }}" required maxlength="5"
                        placeholder="Contoh: 01"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RW <span class="text-red-500">*</span></label>
                    <input type="text" name="rw" value="{{ old('rw') }}" required maxlength="5"
                        placeholder="Contoh: 01"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" required
                        placeholder="Contoh: Jl. Poros ITCI RT 01"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('alamat') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kepala Keluarga <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <select name="kepala_keluarga_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih (bisa diisi nanti) --</option>
                        @foreach ($penduduk as $p)
                            <option value="{{ $p->id }}" @selected(old('kepala_keluarga_id') == $p->id)>{{ $p->nik }} - {{ $p->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" maxlength="20"
                        placeholder="Contoh: 081234567890"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeModal('modal-create')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </x-modal>

    <x-modal id="modal-delete" title="Konfirmasi Hapus">
        <p class="text-sm text-gray-600 mb-2">Apakah Anda yakin ingin menghapus KK ini?</p>
        <p class="text-xs text-red-600">Semua anggota keluarga akan ikut terhapus.</p>
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
    function confirmDelete(url) {
        document.getElementById('delete-form').action = url;
        openModal('modal-delete');
    }
    @if ($errors->any())
    openModal('modal-create');
    @endif
</script>
@endpush
