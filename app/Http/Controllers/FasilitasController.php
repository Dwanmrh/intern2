<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('tanggal', 'desc')->get();
        return view('fasilitas', data: compact('fasilitas'));
    }

    public function umum()
    {
        $fasilitas = Fasilitas::where('kategori', 'umum')->get()->groupBy('subKategori');
        return view('fasilitas.umum', compact('fasilitas'))->with('kategori', 'Fasilitas Umum');
    }

    public function belajar()
    {
        $fasilitas = Fasilitas::where('kategori', 'belajar')->get()->groupBy('subKategori');
        return view('fasilitas.belajar', compact('fasilitas'))->with('kategori', 'Fasilitas Belajar');
    }

    public function khusus()
    {
        $fasilitas = Fasilitas::where('kategori', 'khusus')->get()->groupBy('subKategori');
        return view('fasilitas.khusus', compact('fasilitas'))->with('kategori', 'Fasilitas Khusus');
    }

    public function create()
    {
        return view('fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|string',
            'kategori' => 'required|string|in:umum,belajar,khusus',
            'subKategori' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $data = $validated;

        // Format tanggal dari d/m/Y ke Y-m-d
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Invalid date');
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        Fasilitas::create($data);

        return redirect()->route('fasilitas.' . $data['kategori'])->with('success', 'Fasilitas ' . ucfirst($data['kategori']) . ' berhasil ditambahkan');
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('fasilitas.show', compact('fasilitas'));
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->tanggal = Carbon::parse($fasilitas->tanggal)->format('d/m/Y');

        return view('fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|string',
            'kategori' => 'required|string|in:umum,belajar,khusus',
            'subKategori' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'hapus_foto' => 'nullable|boolean', // ✅ tambahan
        ]);

        $data = $validated;

        // Format tanggal dari d/m/Y ke Y-m-d
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Invalid date');
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // ✅ Hapus foto lama jika dicentang
        if ($request->has('hapus_foto') && $fasilitas->foto) {
            if (Storage::disk('public')->exists($fasilitas->foto)) {
                Storage::disk('public')->delete($fasilitas->foto);
            }
            $data['foto'] = null;
        }

        // ✅ Upload foto baru (menggantikan foto lama)
        if ($request->hasFile('foto')) {
            if ($fasilitas->foto && Storage::disk('public')->exists($fasilitas->foto)) {
                Storage::disk('public')->delete($fasilitas->foto);
            }
            $data['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()->route('fasilitas.' . $data['kategori'])
            ->with('success', 'Fasilitas ' . ucfirst($data['kategori']) . ' berhasil diperbarui');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $kategori = $fasilitas->kategori;

        // Hapus foto dari storage jika ada
        if ($fasilitas->foto && Storage::disk('public')->exists($fasilitas->foto)) {
            Storage::disk('public')->delete($fasilitas->foto);
        }

        $fasilitas->delete();
        return redirect()->route('fasilitas.' . $kategori)->with('success', 'Fasilitas ' . ucfirst($kategori) . ' berhasil dihapus');
    }
}
