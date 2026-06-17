<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    protected $table = 'template_surat';

    protected $fillable = ['nama_template', 'header_surat', 'footer_surat', 'penandatangan', 'jabatan', 'logo', 'aktif'];
}
