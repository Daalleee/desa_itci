<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = ['judul', 'isi_pengumuman', 'lampiran', 'status', 'dipublikasikan_pada', 'dibuat_oleh'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'dipublikasikan_pada' => 'datetime',
        ];
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
