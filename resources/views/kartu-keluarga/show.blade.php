@extends('layouts.admin')

@section('title', 'Detail KK')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl mb-4">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">KK: {{ $kartuKeluarga->nomor_kk }}</h3>
                <p class="text-sm text-gray-500">Status: {{ $kartuKeluarga->status }}</p>
            </div>
            <a href="{{ route('kartu-keluarga.index') }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Kembali</a>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Kepala Keluarga</span><p class="font-medium">{{ $kartuKeluarga->kepalaKeluarga?->nama_lengkap ?? 'Belum ditetapkan' }}</p></div>
            <div><span class="text-gray-500">RT/RW</span><p class="font-medium">{{ $kartuKeluarga->rt }}/{{ $kartuKeluarga->rw }}</p></div>
            <div class="col-span-2"><span class="text-gray-500">Alamat</span><p class="font-medium">{{ $kartuKeluarga->alamat }}</p></div>
            <div><span class="text-gray-500">Kode Pos</span><p class="font-medium">{{ $kartuKeluarga->kode_pos ?? '-' }}</p></div>
            <div><span class="text-gray-500">Telepon</span><p class="font-medium">{{ $kartuKeluarga->nomor_telepon ?? '-' }}</p></div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Anggota Keluarga ({{ $anggota->count() }})</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-medium text-gray-600">NIK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Nama</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Hubungan</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">JK</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Pendidikan</th>
                        <th class="text-left py-3 px-2 font-medium text-gray-600">Pekerjaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggota as $a)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-2">{{ $a->nik }}</td>
                            <td class="py-3 px-2">
                                <a href="{{ route('penduduk.show', $a) }}" class="text-green-700 hover:underline font-medium">{{ $a->nama_lengkap }}</a>
                            </td>
                            <td class="py-3 px-2">{{ $a->hubungan_keluarga }}</td>
                            <td class="py-3 px-2">{{ $a->jenis_kelamin }}</td>
                            <td class="py-3 px-2">{{ $a->pendidikan?->nama_pendidikan ?? '-' }}</td>
                            <td class="py-3 px-2">{{ $a->pekerjaan?->nama_pekerjaan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada anggota.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
