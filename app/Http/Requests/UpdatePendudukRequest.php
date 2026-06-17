<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendudukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|string|size:16|unique:penduduk,nik,' . $this->route('penduduk')->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama_id' => 'required|exists:agama,id',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'required|in:belum_kawin,kawin,cerai_hidup,cerai_mati',
            'golongan_darah' => 'nullable|string|max:5',
            'nomor_telepon' => 'nullable|string|max:20',
            'kartu_keluarga_id' => 'nullable|exists:kartu_keluarga,id',
            'hubungan_keluarga' => 'nullable|string|max:100',
            'status_penduduk' => 'nullable|in:aktif,pindah,meninggal,pendatang',
            'foto' => 'nullable|image|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'nik' => 'NIK',
            'nama_lengkap' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama_id' => 'Agama',
            'pendidikan' => 'Pendidikan',
            'pekerjaan' => 'Pekerjaan',
            'status_perkawinan' => 'Status Perkawinan',
            'kartu_keluarga_id' => 'Nomor KK',
            'hubungan_keluarga' => 'Hubungan Keluarga',
            'status_penduduk' => 'Status Penduduk',
            'foto' => 'Foto',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'nik.size' => 'NIK harus 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'jenis_kelamin.in' => 'Pilih Laki-laki atau Perempuan.',
            'agama_id.exists' => 'Agama tidak valid.',
            'status_perkawinan.in' => 'Status perkawinan tidak valid.',
            'kartu_keluarga_id.exists' => 'Nomor KK tidak valid.',
            'status_penduduk.in' => 'Status penduduk tidak valid.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        ];
    }
}
