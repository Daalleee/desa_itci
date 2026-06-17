<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    protected $fillable = ['sejarah', 'visi', 'misi', 'sambutan', 'luas_wilayah', 'batas_utara', 'batas_selatan', 'batas_timur', 'batas_barat'];
}
