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
                'url' => route('informasi.index', $item->id),
                'category' => 'Informasi'
            ]);

        $fasilitas = Fasilitas::where('judul', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->select('id', 'judul as title')
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'url' => route('fasilitas.index', $item->id),
                'category' => 'FASDIK'
            ]);

        $modul = Modul::where('judul', 'like', "%{$query}%")
        ->orWhere('deskripsi', 'like', "%{$query}%")
        ->select('id', 'judul as title', 'prodiklat')
        ->get()
        ->map(function ($item) {
            if (!auth()->check()) {
                return [
                    'title' => $item->title,
                    'url' => route('login'), // arahkan ke login
                    'category' => 'Modul (Harus Login)'
                ];
            }

            // Tentukan route berdasarkan prodiklat
            $baseUrl = match (strtoupper($item->prodiklat)) {
                'SIP' => route('modul.sip'),
                'PAG' => route('modul.pag'),
                default => route('modul.index'),
            };

            return [
                'title' => $item->title,
                'url' => $baseUrl . "#modul{$item->id}",
                'category' => strtoupper($item->prodiklat ?? 'Modul')
            ];
        });

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
