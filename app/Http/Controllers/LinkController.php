<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tampilkan hanya link kategori "umum"
        $links = Link::where('kategori', 'umum')->get();
        return view('link', compact('links'));
    }

    public function sadiklat()
    {
        // Tampilkan hanya link kategori "sadiklat"
        $links = Link::where('kategori', 'sadiklat')->get();
        return view('link.sadiklat', ['sadiklat' => $links]);
    }


    public function create()
    {
        return view('link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:15000',
            'kategori' => 'required|in:umum,sadiklat',
            'subkategori' => $request->kategori === 'sadiklat' ? 'required|string|max:255' : 'nullable|string|max:255',
        ]);

        $logoPath = $request->file('logo')->store('logo_link', 'public');

        Link::create([
            'nama' => $request->nama,
            'url' => $request->url,
            'logo' => $logoPath,
            'kategori' => $request->kategori,
            'subkategori' => $request->subkategori,
        ]);

        return redirect()->route(
    $request->kategori === 'sadiklat' ? 'sadiklat.index' : 'link.index'
        )->with(
            'success',
            $request->kategori === 'sadiklat'
                ? 'Link sadiklat berhasil ditambahkan.'
                : 'Link umum berhasil ditambahkan.'
        );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $link = Link::findOrFail($id);
        return view('link.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:15000',
            'kategori' => 'required|in:umum,sadiklat',
            'subkategori' => $request->kategori === 'sadiklat' ? 'required|string|max:255' : 'nullable|string|max:255',        ]);

        $data = [
            'nama' => $request->nama,
            'url' => $request->url,
            'kategori' => $request->kategori,
            'subkategori' => $request->kategori === 'sadiklat' ? $request->subkategori : null,
        ];

        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($link->logo && Storage::disk('public')->exists($link->logo)) {
                Storage::disk('public')->delete($link->logo);
            }

            $data['logo'] = $request->file('logo')->store('logo_link', 'public');
        }

        $link->update($data);

         // Redirect berdasarkan kategori
        if ($request->kategori === 'sadiklat') {
            return redirect()->route('sadiklat.index')->with('success', 'Link sadiklat berhasil diperbarui.');
        }

        return redirect()->route('link.index')->with('success', 'Link umum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);

        if ($link->logo && Storage::disk('public')->exists($link->logo)) {
            Storage::disk('public')->delete($link->logo);
        }

        $kategori = $link->kategori; // simpan sebelum dihapus
        $link->delete();

        // Tentukan redirect dan pesan berdasarkan kategori
        if ($kategori === 'sadiklat') {
            return redirect()->route('sadiklat.index')->with('success', 'Link sadiklat berhasil dihapus.');
        }

        return redirect()->route('link.index')->with('success', 'Link umum berhasil dihapus.');
    }
}
