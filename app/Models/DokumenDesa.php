<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenDesa extends Model
{
    protected $table = 'dokumen_desa';

    protected $fillable = ['kategori', 'judul', 'deskripsi', 'nama_file', 'lokasi_file', 'dibuat_oleh'];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
