<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = ['kode_surat', 'nama_surat', 'deskripsi', 'aktif'];
}
