<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenWarga extends Model
{
    protected $table = 'dokumen_warga';

    protected $fillable = ['penduduk_id', 'jenis_dokumen', 'nama_file', 'lokasi_file', 'ukuran_file'];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
