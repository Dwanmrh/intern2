<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        Berita::create($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beritas = Berita::findOrFail($id);
        return view('berita.edit', compact('beritas'));
    }

    public function update(Request $request, $id)
    {
        $beritas = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        $beritas->update($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $beritas = Berita::findOrFail($id);
        $beritas->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
