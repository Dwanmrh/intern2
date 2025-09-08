<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($id)
    {
        $berita = Berita::findOrFail($id);
        $user = Auth::user();

        if ($berita->isLikedBy($user)) {
            // Unlike
            $berita->likes()->detach($user->id);
            $status = 'unliked';
        } else {
            // Like
            $berita->likes()->attach($user->id);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'total_likes' => $berita->likes()->count()
        ]);
    }
}
