<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiSistem extends Model
{
    protected $table = 'notifikasi_sistem';

    protected $fillable = ['judul', 'pesan', 'tipe', 'dibaca', 'pengguna_id'];

    protected function casts(): array
    {
        return [
            'dibaca' => 'boolean',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
