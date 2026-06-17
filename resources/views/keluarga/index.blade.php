@extends('layouts.admin')

@section('title', 'Daftar Keluarga')

@php
    $hubunganLabels = [
        'kepala_keluarga' => 'Kepala Keluarga',
        'istri' => 'Istri',
        'anak_kandung' => 'Anak Kandung',
        'anak_angkat' => 'Anak Angkat',
        'anak_tiri' => 'Anak Tiri',
        'ayah' => 'Ayah',
        'ibu' => 'Ibu',
        'mertua' => 'Mertua',
        'paman' => 'Paman',
        'bibi' => 'Bibi',
        'sepupu' => 'Sepupu',
        'keponakan' => 'Keponakan',
        'kerabat' => 'Kerabat',
    ];
@endphp

@section('content')
    <div class="space-y-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-4">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari No KK, nama kepala keluarga, atau anggota..."
                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-72">
                    <button type="submit" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">Cari</button>
                    @if ($search)
                        <a href="{{ route('keluarga.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">Reset</a>
                    @endif
                </form>
                <a href="{{ route('keluarga.create') }}" class="px-4 py-2 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800">+ Keluarga Baru</a>
            </div>

            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            @forelse ($keluarga as $k)
                <div class="border border-gray-200 rounded-lg overflow-hidden mb-4 last:mb-0">
                    {{-- Header Keluarga --}}
                    <div class="bg-gradient-to-r from-green-700 to-green-600 px-5 py-3 flex items-center justify-between">
                        <div>
                            <a href="{{ route('keluarga.show', $k) }}" class="text-white font-semibold hover:underline">{{ $k->nomor_kk }}</a>
                            <span class="text-green-200 text-xs ml-3">RT {{ $k->rt }}/RW {{ $k->rw }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $k->status === 'aktif' ? 'bg-green-600 text-white' : 'bg-red-500 text-white' }}">{{ $k->status }}</span>
                            <a href="{{ route('keluarga.show', $k) }}" class="px-2.5 py-1 text-xs bg-white/20 text-white rounded-md hover:bg-white/30 transition">Detail</a>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="px-5 py-2 bg-gray-50 border-b border-gray-100 text-xs text-gray-500">
                        {{ $k->alamat }} &middot; {{ $k->anggotaKeluarga->count() }} anggota
                    </div>

                    {{-- Daftar Anggota --}}
                    <div class="divide-y divide-gray-50">
                        @php $kepala = $k->kepalaKeluarga; @endphp
                        @foreach ($k->anggotaKeluarga as $anggota)
                            @php
                                $hub = $anggota->hubungan_keluarga;
                                $label = $hubunganLabels[$hub] ?? ucfirst(str_replace('_', ' ', $hub));

                                if ($hub === 'kepala_keluarga') {
                                    $ket = 'Kepala Keluarga';
                                } elseif ($hub === 'istri') {
                                    $ket = 'Istri dari ' . ($kepala?->nama_lengkap ?? '-');
                                } elseif (in_array($hub, ['anak_kandung', 'anak_angkat', 'anak_tiri'])) {
                                    $ket = $label . ' dari ' . ($kepala?->nama_lengkap ?? '-') . ' & ' . ($k->anggotaKeluarga->firstWhere('hubungan_keluarga', 'istri')?->nama_lengkap ?? '-');
                                } elseif (in_array($hub, ['ayah', 'ibu', 'mertua'])) {
                                    $namaOrtu = $k->anggotaKeluarga->firstWhere('hubungan_keluarga', $hub === 'mertua' ? 'istri' : 'kepala_keluarga')?->nama_lengkap ?? $kepala?->nama_lengkap ?? '-';
                                    $ket = $label . ' dari ' . ($hub === 'mertua' ? ($kepala?->nama_lengkap ?? '-') : ($kepala?->nama_lengkap ?? '-'));
                                } else {
                                    $ket = $label . ' dari Keluarga ' . ($kepala?->nama_lengkap ?? '-');
                                }
                            @endphp
                            <div class="px-5 py-2.5 flex items-center justify-between hover:bg-gray-50/50 transition">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                        <span class="text-xs font-semibold text-gray-500">{{ strtoupper(substr($anggota->nama_lengkap, 0, 1)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-gray-800 truncate">{{ $anggota->nama_lengkap }}</p>
                                        <p class="text-xs text-gray-400">{{ $ket }}</p>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-400 shrink-0 ml-3">NIK {{ $anggota->nik }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">Belum ada data keluarga.</div>
            @endforelse

            <div class="mt-4">{{ $keluarga->links() }}</div>
        </div>
    </div>
@endSection
