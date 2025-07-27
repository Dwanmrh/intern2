<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Pimpinan;
use App\Models\Berita;
use App\Models\Informasi;
use App\Models\Galeri;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $dashboard = Dashboard::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('dashboard.index') . "#item{$item->id}",
                'category' => 'Home'
            ]);

        $profil = Pimpinan::where('nama', 'like', "%{$query}%")
            ->select('id', 'nama as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('profil') . "#pimpinan{$item->id}",
                'category' => 'Profil'
            ]);

        $berita = Berita::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('berita') . "#berita{$item->id}",
                'category' => 'Berita'
            ]);

        $informasi = Informasi::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('informasi.index') . "#info{$item->id}",
                'category' => 'Informasi'
            ]);

        $galeri = Galeri::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('galeri.index') . "#galeri{$item->id}",
                'category' => 'Galeri'
            ]);

        $results = collect()
            ->merge($dashboard)
            ->merge($profil)
            ->merge($berita)
            ->merge($informasi)
            ->merge($galeri)
            ->unique('url')
            ->values(); // reset indexing

        return response()->json($results);
    }
}
