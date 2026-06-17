<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'terakhir_login' => 'datetime',
        ];
    }

    public function aktivitasSistem()
    {
        return $this->hasMany(AktivitasSistem::class, 'pengguna_id');
    }

    public function backupDatabase()
    {
        return $this->hasMany(BackupDatabase::class, 'dibuat_oleh');
    }

    public function notifikasi()
    {
        return $this->hasMany(NotifikasiSistem::class, 'pengguna_id');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class, 'dibuat_oleh');
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'dibuat_oleh');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'dibuat_oleh');
    }
}
