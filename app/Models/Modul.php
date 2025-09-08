<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'prodiklat',
        'mapel',
        'tahun',
        'file',
    ];

}
