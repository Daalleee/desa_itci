<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfigurasiDesa extends Model
{
    protected $table = 'konfigurasi_desa';

    protected $fillable = ['nama_desa', 'alamat', 'telepon', 'email', 'logo', 'nama_kepala_desa', 'nama_sekretaris'];
}
