<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $fillable = [
        'nomor_kk', 'rt', 'rw', 'wilayah_id', 'alamat', 'kode_pos',
        'nomor_telepon', 'kepala_keluarga_id', 'status',
    ];

    protected $table = 'kartu_keluarga';

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Penduduk::class, 'kepala_keluarga_id');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(Penduduk::class, 'kartu_keluarga_id');
    }
}
