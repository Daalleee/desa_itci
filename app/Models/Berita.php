<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul', 'slug', 'ringkasan', 'isi_berita',
        'gambar_utama', 'status', 'dipublikasikan_pada', 'dibuat_oleh',
    ];

    protected $table = 'berita';

    protected function casts(): array
    {
        return [
            'dipublikasikan_pada' => 'datetime',
        ];
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
