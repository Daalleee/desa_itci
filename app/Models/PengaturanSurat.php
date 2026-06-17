<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSurat extends Model
{
    protected $table = 'pengaturan_surat';

    protected $fillable = ['format_nomor', 'prefix', 'reset_nomor_tahunan'];

    protected function casts(): array
    {
        return [
            'reset_nomor_tahunan' => 'boolean',
        ];
    }
}
