<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '_peran' => 'required|in:kepala_keluarga,istri,anak,kerabat',
            'nik' => 'required|string|size:16|unique:penduduk,nik',
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
            'foto' => 'nullable|image|max:2048',
            'nomor_kk_baru' => 'nullable|required_if:_peran,kepala_keluarga|string|max:20|unique:kartu_keluarga,nomor_kk',
            'rt_baru' => 'nullable|required_if:_peran,kepala_keluarga|string|max:10',
            'rw_baru' => 'nullable|required_if:_peran,kepala_keluarga|string|max:10',
            'alamat_baru' => 'nullable|required_if:_peran,kepala_keluarga|string',
        ];
    }

    public function attributes(): array
    {
        return [
            '_peran' => 'Peran dalam Keluarga',
            'nik' => 'NIK',
            'nama_lengkap' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama_id' => 'Agama',
            'pendidikan' => 'Pendidikan',
            'pekerjaan' => 'Pekerjaan',
            'status_perkawinan' => 'Status Perkawinan',
            'kartu_keluarga_id' => 'Kartu Keluarga',
            'foto' => 'Foto',
            'nomor_kk_baru' => 'Nomor KK',
            'rt_baru' => 'RT',
            'rw_baru' => 'RW',
            'alamat_baru' => 'Alamat',
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
            'kartu_keluarga_id.exists' => 'KK tidak ditemukan.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'nomor_kk_baru.unique' => 'Nomor KK sudah terdaftar.',
            '_peran.in' => 'Pilih peran dalam keluarga.',
        ];
    }
}
