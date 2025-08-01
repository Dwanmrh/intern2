<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::orderBy('tanggal', 'desc')->get();
        return view('informasi', compact('informasi'));
    }

    public function create()
    {
        return view('informasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

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

        Informasi::create($validated);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('informasi.show', compact('informasi'));
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->tanggal = Carbon::parse($informasi->tanggal)->format('d/m/Y');

        return view('informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

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

        $informasi->update($validated);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->foto && Storage::disk('public')->exists($informasi->foto)) {
            Storage::disk('public')->delete($informasi->foto);
        }

        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
