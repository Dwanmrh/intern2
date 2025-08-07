<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
     use HasFactory;

    // Nama tabel (opsional kalau nama tabel tidak jamak)
    protected $table = 'links';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama',
        'url',
        'logo',
        'kategori',
        'subkategori',
    ];
}
