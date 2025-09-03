<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Profil;
use App\Models\Berita;
use App\Models\Informasi;
use App\Models\Fasilitas;
use App\Models\Modul;

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
            ->orWhere('jabatan', 'like', "%{$query}%")
            ->select('id', 'nama as title', 'jabatan')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title . ' - ' . ($item->jabatan ?? ''),
                'url' => route('profil.index') . "#profil{$item->id}",
                'category' => 'Profil'
            ]);

        $berita = Berita::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('berita.show', $item->id),
                'category' => 'Berita'
            ]);

        $informasi = Informasi::where('judul', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('informasi.show', $item->id),
                'category' => 'Informasi'
            ]);

        $fasilitas = Fasilitas::where('judul', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('fasilitas.show', $item->id),
                'category' => 'FASDIK'
            ]);

        $modul = Modul::where('judul', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->select('id', 'judul as title', 'prodiklat')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('modul.index') . "#modul{$item->id}",
                'category' => strtoupper($item->prodiklat ?? 'Modul')
            ]);

        $results = collect()
            ->merge($dashboard)
            ->merge($profil)
            ->merge($berita)
            ->merge($informasi)
            ->merge($fasilitas)
            ->merge($modul)
            ->unique('url')
            ->values();

        return response()->json($results);
    }
}
