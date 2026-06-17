<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailImportError extends Model
{
    protected $table = 'detail_import_error';

    protected $fillable = ['riwayat_import_id', 'nomor_baris', 'pesan_error', 'data_baris'];

    protected function casts(): array
    {
        return [
            'data_baris' => 'array',
        ];
    }

    public function riwayatImport()
    {
        return $this->belongsTo(RiwayatImport::class);
    }
}
