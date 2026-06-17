@extends('layouts.admin')

@section('title', 'Detail Penduduk')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $penduduk->nama_lengkap }}</h3>
                <p class="text-sm text-gray-500">NIK: {{ $penduduk->nik }}</p>
                <p class="text-sm text-gray-500">Kode: {{ $penduduk->kode_warga }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('penduduk.index') }}" class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Edit</a>
                <a href="{{ route('penduduk.index') }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Kembali</a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Tempat, Tgl Lahir</span><p class="font-medium">{{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir?->format('d/m/Y') }}</p></div>
            <div><span class="text-gray-500">Jenis Kelamin</span><p class="font-medium">{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p></div>
            <div><span class="text-gray-500">Agama</span><p class="font-medium">{{ $penduduk->agama?->nama_agama }}</p></div>
            <div><span class="text-gray-500">Pendidikan</span><p class="font-medium">{{ $penduduk->pendidikan ?? '-' }}</p></div>
            <div><span class="text-gray-500">Pekerjaan</span><p class="font-medium">{{ $penduduk->pekerjaan ?? '-' }}</p></div>
            <div><span class="text-gray-500">Status Perkawinan</span><p class="font-medium">{{ $penduduk->status_perkawinan }}</p></div>
            <div><span class="text-gray-500">Golongan Darah</span><p class="font-medium">{{ $penduduk->golongan_darah ?? '-' }}</p></div>
            <div><span class="text-gray-500">Nomor Telepon</span><p class="font-medium">{{ $penduduk->nomor_telepon ?? '-' }}</p></div>
            <div><span class="text-gray-500">Nomor KK</span><p class="font-medium">{{ $penduduk->kartuKeluarga?->nomor_kk }}</p></div>
            <div><span class="text-gray-500">RT/RW</span><p class="font-medium">{{ $penduduk->kartuKeluarga?->rt }}/{{ $penduduk->kartuKeluarga?->rw }}</p></div>
            <div><span class="text-gray-500">Hubungan Keluarga</span><p class="font-medium">{{ $penduduk->hubungan_keluarga }}</p></div>
            <div><span class="text-gray-500">Status Penduduk</span><p class="font-medium">{{ $penduduk->status_penduduk }}</p></div>
        </div>
    </div>
@endsection
