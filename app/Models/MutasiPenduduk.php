<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiPenduduk extends Model
{
    protected $table = 'mutasi_penduduk';

    protected $fillable = [
        'penduduk_id', 'jenis_mutasi', 'tanggal_mutasi',
        'asal_tujuan', 'alasan', 'keterangan', 'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mutasi' => 'date',
        ];
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
