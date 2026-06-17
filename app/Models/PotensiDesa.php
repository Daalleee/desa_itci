<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    protected $table = 'potensi_desa';

    protected $fillable = ['nama_potensi', 'kategori', 'deskripsi', 'foto', 'lokasi'];
}
