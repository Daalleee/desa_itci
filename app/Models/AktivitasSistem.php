<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasSistem extends Model
{
    protected $table = 'aktivitas_sistem';

    protected $fillable = ['pengguna_id', 'modul', 'aktivitas', 'data_lama', 'data_baru', 'alamat_ip', 'user_agent'];

    protected function casts(): array
    {
        return [
            'data_lama' => 'array',
            'data_baru' => 'array',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
