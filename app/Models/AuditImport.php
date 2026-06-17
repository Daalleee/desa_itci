<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditImport extends Model
{
    protected $table = 'audit_import';

    protected $fillable = ['riwayat_import_id', 'aksi', 'pengguna_id'];

    public function riwayatImport()
    {
        return $this->belongsTo(RiwayatImport::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
