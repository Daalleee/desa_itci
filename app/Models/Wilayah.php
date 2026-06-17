<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $fillable = ['rt', 'rw', 'nama_wilayah', 'aktif'];
}
