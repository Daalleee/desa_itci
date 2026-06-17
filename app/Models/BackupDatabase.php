<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupDatabase extends Model
{
    protected $table = 'backup_database';

    protected $fillable = ['nama_file', 'ukuran_file', 'lokasi_file', 'dibuat_oleh'];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
