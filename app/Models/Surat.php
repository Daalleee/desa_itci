<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat', 'penduduk_id', 'jenis_surat_id',
        'keperluan', 'data_snapshot', 'file_pdf',
        'dicetak_pada', 'dibuat_oleh',
    ];

    protected $table = 'surat';

    protected function casts(): array
    {
        return [
            'data_snapshot' => 'array',
            'dicetak_pada' => 'datetime',
        ];
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
