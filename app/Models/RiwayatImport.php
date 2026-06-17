<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatImport extends Model
{
    protected $table = 'riwayat_import';

    protected $fillable = [
        'jenis_import', 'nama_file', 'lokasi_file', 'total_baris',
        'berhasil_import', 'gagal_import', 'status', 'catatan', 'diimpor_oleh',
    ];

    public function diimporOleh()
    {
        return $this->belongsTo(User::class, 'diimpor_oleh');
    }

    public function detailError()
    {
        return $this->hasMany(DetailImportError::class);
    }

    public function audit()
    {
        return $this->hasMany(AuditImport::class);
    }
}
