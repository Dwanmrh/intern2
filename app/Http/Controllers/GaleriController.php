<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_galeri', 'public');
        }

        Galeri::create($validated);
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil ditambahkan');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_galeri', 'public');
        }

        $galeri->update($validated);
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil dihapus');
    }
}
