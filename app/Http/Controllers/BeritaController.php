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
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:23000',
            'file_berita' => 'nullable|mimes:pdf|max:15000',
        ]);

        // Cek rule: isi berita manual + upload PDF → error
        if ($request->filled('isi_berita') && $request->hasFile('file_berita')) {
            return back()->withErrors([
                'file_berita' => 'Jika isi berita diisi manual, jangan upload file PDF.'
            ])->withInput();
        }

        // Cek rule: isi berita kosong + tidak ada file → error
        if (!$request->filled('isi_berita') && !$request->hasFile('file_berita')) {
            return back()->withErrors([
                'isi_berita' => 'Isi berita atau file PDF harus diisi salah satu.'
            ])->withInput();
        }

        $data = $request->only('judul', 'isi_berita');

        // Format tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception();
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        // PDF (hanya kalau isi_berita kosong)
        if (!$request->filled('isi_berita') && $request->hasFile('file_berita')) {
            $file = $request->file('file_berita');
            $parser = new PdfParser();
            $pdf = $parser->parseFile($file->getPathname());
            $data['isi_berita'] = $pdf->getText();
            $data['file_berita'] = $file->store('file_berita', 'public');
        }

        // Default isi_berita kalau kosong
        if (empty($data['isi_berita'])) {
            $data['isi_berita'] = '-';
        }

        Berita::create($data);
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

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'nullable|string',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:23000',
            'file_berita' => 'nullable|mimes:pdf|max:15000',
        ]);

        // Rule: isi berita manual + upload PDF → error
        if ($request->filled('isi_berita') && $request->hasFile('file_berita')) {
            return back()->withErrors([
                'file_berita' => 'Jika isi berita diisi manual, jangan upload file PDF.'
            ])->withInput();
        }

        // Rule: isi berita kosong + tidak ada file PDF (serta file lama dihapus) → error
        if (
            !$request->filled('isi_berita') &&
            !$request->hasFile('file_berita') &&
            ($request->filled('hapus_file') && $request->hapus_file == 1) &&
            !$berita->file_berita
        ) {
            return back()->withErrors([
                'isi_berita' => 'Isi berita atau file PDF harus diisi salah satu.'
            ])->withInput();
        }

        $data = $request->only('judul', 'isi_berita');

        // Format tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception();
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // =============================
        // HANDLE FOTO
        // =============================

        // Upload foto baru → hapus lama
        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        // Hapus foto lama (checkbox)
        if ($request->filled('hapus_foto') && $request->hapus_foto == 1) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = null;
        }

        // =============================
        // HANDLE FILE PDF
        // =============================

        // Hapus file PDF lama (checkbox)
        if ($request->filled('hapus_file') && $request->hapus_file == 1) {
            if ($berita->file_berita && Storage::disk('public')->exists($berita->file_berita)) {
                Storage::disk('public')->delete($berita->file_berita);
            }
            $data['file_berita'] = null;
        }

        // Upload file PDF baru (hanya kalau isi berita kosong)
        if (!$request->filled('isi_berita') && $request->hasFile('file_berita')) {
            if ($berita->file_berita && Storage::disk('public')->exists($berita->file_berita)) {
                Storage::disk('public')->delete($berita->file_berita);
            }
            $file = $request->file('file_berita');
            $parser = new PdfParser();
            $pdf = $parser->parseFile($file->getPathname());
            $data['isi_berita'] = $pdf->getText();
            $data['file_berita'] = $file->store('file_berita', 'public');
        }

        $berita->update($data);
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
