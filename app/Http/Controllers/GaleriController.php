<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')->get();
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
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Konversi tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Format tidak valid');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Siapkan data
        $data = $validated;
        $data['tanggal'] = $tanggal->format('Y-m-d');

        // Simpan file jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($data);
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil ditambahkan');
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.show', compact('galeri'));
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->tanggal = Carbon::parse($galeri->tanggal)->format('d/m/Y');

        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Format tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Format tidak valid');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Siapkan data update
        $data = $validated;
        $data['tanggal'] = $tanggal->format('Y-m-d');

        // Ganti foto jika ada upload baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file foto dari storage
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Konten berhasil dihapus');
    }
}
