@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Total Penduduk</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalPenduduk }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Total KK</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalKK }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Laki-laki</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalLaki }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Perempuan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalPerempuan }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Surat Hari Ini</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $suratHariIni }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Surat Bulan Ini</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $suratBulanIni }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Berita</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalBerita }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Pengumuman</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalPengumuman }}</p>
        </div>
    </div>
@endsection
