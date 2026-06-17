@extends('layouts.admin')

@section('title', 'Detail Mutasi')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 max-w-2xl">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail Mutasi</h3>
                <p class="text-sm text-gray-500">{{ $mutasi->penduduk?->nama_lengkap }}</p>
            </div>
            <a href="{{ route('mutasi.index') }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Kembali</a>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">NIK</span><p class="font-medium">{{ $mutasi->penduduk?->nik }}</p></div>
            <div><span class="text-gray-500">Nama</span><p class="font-medium">{{ $mutasi->penduduk?->nama_lengkap }}</p></div>
            <div><span class="text-gray-500">Jenis Mutasi</span><p class="font-medium">{{ $mutasi->jenis_mutasi }}</p></div>
            <div><span class="text-gray-500">Tanggal</span><p class="font-medium">{{ $mutasi->tanggal_mutasi?->format('d/m/Y') }}</p></div>
            <div><span class="text-gray-500">Asal/Tujuan</span><p class="font-medium">{{ $mutasi->asal_tujuan }}</p></div>
            <div><span class="text-gray-500">Alasan</span><p class="font-medium">{{ $mutasi->alasan }}</p></div>
            <div class="col-span-2"><span class="text-gray-500">Keterangan</span><p class="font-medium">{{ $mutasi->keterangan ?? '-' }}</p></div>
            <div><span class="text-gray-500">Petugas</span><p class="font-medium">{{ $mutasi->dibuatOleh?->name }}</p></div>
        </div>
    </div>
@endsection
