<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'kode_warga', 'kartu_keluarga_id', 'nik', 'nama_lengkap',
        'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'agama_id', 'pekerjaan', 'pendidikan',
        'status_perkawinan', 'golongan_darah', 'nomor_telepon',
        'hubungan_keluarga', 'status_penduduk', 'foto',
    ];

    protected $table = 'penduduk';

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function mutasi()
    {
        return $this->hasMany(MutasiPenduduk::class);
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }

    public function dokumenWarga()
    {
        return $this->hasMany(DokumenWarga::class);
    }

    public function kepalaKeluarga()
    {
        return $this->hasOne(KartuKeluarga::class, 'kepala_keluarga_id');
    }
}
