<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Profil;
use App\Models\Berita;
use App\Models\Informasi;
use App\Models\Fasilitas;
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

        $profil = Profil::where('nama', 'like', "%{$query}%")
            ->select('id', 'nama as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('profil.index') . "#profil{$item->id}",
                'category' => 'Profil'
            ]);

        $berita = Berita::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('berita.index') . "#berita{$item->id}",
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

            $fasilitas = Fasilitas::where('judul', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('fasilitas.index') . "#fasilitas{$item->id}",
                'category' => 'FASDIK'
            ]);

        $results = collect()
            ->merge($dashboard)
            ->merge($profil)
            ->merge($berita)
            ->merge($informasi)
            ->merge($fasilitas)
            ->unique('url')
            ->values(); // reset indexing

        return response()->json($results);
    }
}
