<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi_berita', 'tanggal', 'foto', 'file_berita'];

    public function likes()
    {
        return $this->belongsToMany(User::class, 'berita_user_likes')->withTimestamps();
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

}
