<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Modul extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'prodiklat',
        'mapel',
        'tahun',
        'file',
    ];

}
