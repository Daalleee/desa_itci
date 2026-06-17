<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKartuKeluargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor_kk' => 'required|string|max:20|unique:kartu_keluarga,nomor_kk',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'kepala_keluarga_id' => 'nullable|exists:penduduk,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'nomor_kk' => 'Nomor KK',
            'rt' => 'RT',
            'rw' => 'RW',
            'alamat' => 'Alamat',
            'kepala_keluarga_id' => 'Kepala Keluarga',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'nomor_kk.unique' => 'Nomor KK sudah terdaftar.',
            'kepala_keluarga_id.exists' => 'Penduduk tidak ditemukan.',
        ];
    }
}
