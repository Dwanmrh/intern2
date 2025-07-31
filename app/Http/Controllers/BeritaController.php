<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser as PdfParser;
use Carbon\Carbon;


class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
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
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'file_berita' => 'nullable|mimes:pdf|max:10240',
        ]);

        try {
            $validated['tanggal'] = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        if (!$request->filled('isi_berita') && $request->hasFile('file_berita')) {
            $file = $request->file('file_berita');
            $parser = new PdfParser();
            $pdf = $parser->parseFile($file->getPathname());
            $validated['isi_berita'] = $pdf->getText();
            $validated['file_berita'] = $file->store('file_berita', 'public');
        }

        Berita::create($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->tanggal = Carbon::parse($berita->tanggal)->format('d/m/Y');

        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'file_berita' => 'nullable|mimes:pdf|max:10240',
        ]);

        try {
            $validated['tanggal'] = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        if ($request->hasFile('file_berita')) {
            $file = $request->file('file_berita');

            if (!$request->filled('isi_berita')) {
                $parser = new PdfParser();
                $pdf = $parser->parseFile($file->getPathname());
                $validated['isi_berita'] = $pdf->getText();
            }

            if ($berita->file_berita && Storage::disk('public')->exists($berita->file_berita)) {
                Storage::disk('public')->delete($berita->file_berita);
            }

            $validated['file_berita'] = $file->store('file_berita', 'public');
        }

        if (empty($validated['isi_berita'])) {
            $validated['isi_berita'] = '-';
        }

        $berita->update($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }
        if ($berita->file_berita && Storage::disk('public')->exists($berita->file_berita)) {
            Storage::disk('public')->delete($berita->file_berita);
        }

        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
