<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser as PdfParser;
use Carbon\Carbon;

class BeritaController extends Controller
{
    // Tampilkan semua berita
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('berita', compact('beritas'));
    }

    // Tampilkan form tambah berita
    public function create()
    {
        return view('berita.create');
    }

    // Simpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'file_berita' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('judul', 'isi_berita');

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

        // FOTO
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        // PDF
        if (!$request->filled('isi_berita') && $request->hasFile('file_berita')) {
            $file = $request->file('file_berita');
            $parser = new PdfParser();
            $pdf = $parser->parseFile($file->getPathname());
            $data['isi_berita'] = $pdf->getText();
            $data['file_berita'] = $file->store('file_berita', 'public');
        } elseif ($request->hasFile('file_berita')) {
            $data['file_berita'] = $request->file('file_berita')->store('file_berita', 'public');
        }

        if (empty($data['isi_berita'])) {
            $data['isi_berita'] = '-';
        }

        Berita::create($data);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Tampilkan detail
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    // Form edit berita
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->tanggal = Carbon::parse($berita->tanggal)->format('d/m/Y');

        return view('berita.edit', compact('berita'));
    }

    // Update berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'file_berita' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('judul', 'isi_berita');

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

        // FOTO
        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        // PDF
        if ($request->hasFile('file_berita')) {
            if ($berita->file_berita && Storage::disk('public')->exists($berita->file_berita)) {
                Storage::disk('public')->delete($berita->file_berita);
            }

            $file = $request->file('file_berita');

            if (!$request->filled('isi_berita')) {
                $parser = new PdfParser();
                $pdf = $parser->parseFile($file->getPathname());
                $data['isi_berita'] = $pdf->getText();
            }

            $data['file_berita'] = $file->store('file_berita', 'public');
        }

        if (empty($data['isi_berita'])) {
            $data['isi_berita'] = '-';
        }

        $berita->update($data);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Hapus berita
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
