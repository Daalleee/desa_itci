@extends('layouts.admin')

@section('title', 'Mutasi Penduduk')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <select name="jenis_mutasi" onchange="this.form.submit()"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Semua Mutasi</option>
                    <option value="masuk" @selected($jenisMutasi === 'masuk')>Penduduk Masuk</option>
                    <option value="keluar" @selected($jenisMutasi === 'keluar')>Penduduk Keluar</option>
                    <option value="meninggal" @selected($jenisMutasi === 'meninggal')>Penduduk Meninggal</option>
                </select>
                @if ($jenisMutasi)
                    <a href="{{ route('mutasi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Reset</a>
                @endif
            </form>
            <button onclick="openModal('modal-create')" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">+ Catat Mutasi</button>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Tanggal</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Nama</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Jenis</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Asal/Tujuan</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Alasan</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mutasi as $m)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-2">{{ $m->tanggal_mutasi?->format('d/m/Y') }}</td>
                            <td class="py-3 px-2">{{ $m->penduduk?->nama_lengkap }}</td>
                            <td class="py-3 px-2">
                                <span class="px-2 py-0.5 text-xs rounded-full
                                    {{ $m->jenis_mutasi === 'masuk' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $m->jenis_mutasi === 'keluar' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $m->jenis_mutasi === 'meninggal' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $m->jenis_mutasi }}
                                </span>
                            </td>
                            <td class="py-3 px-2">{{ $m->asal_tujuan }}</td>
                            <td class="py-3 px-2 max-w-xs truncate">{{ $m->alasan }}</td>
                            <td class="py-3 px-2">{{ $m->dibuatOleh?->name }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada mutasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $mutasi->links() }}</div>
    </div>

    @push('modals')
    <x-modal id="modal-create" title="Catat Mutasi">
        <form method="POST" action="{{ route('mutasi.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penduduk *</label>
                    <select name="penduduk_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($penduduk as $p)<option value="{{ $p->id }}">{{ $p->nik }} - {{ $p->nama_lengkap }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Mutasi *</label>
                    <select name="jenis_mutasi" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih --</option>
                        <option value="masuk">Penduduk Masuk</option>
                        <option value="keluar">Penduduk Keluar</option>
                        <option value="meninggal">Penduduk Meninggal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mutasi *</label>
                    <input type="date" name="tanggal_mutasi" value="{{ old('tanggal_mutasi') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal / Tujuan *</label>
                    <input type="text" name="asal_tujuan" value="{{ old('asal_tujuan') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan *</label>
                    <input type="text" name="alasan" value="{{ old('alasan') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('keterangan') }}</textarea>
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeModal('modal-create')" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Simpan</button>
            </div>
        </form>
    </x-modal>
    @endpush
@push('scripts')
<script>
    @if (count($errors) > 0)
    openModal('modal-create');
    @endif
</script>
@endpush
@endsection
