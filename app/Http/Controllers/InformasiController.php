<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser as PdfParser;
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_informasi' => 'nullable|mimes:pdf|max:10240',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        // Format tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) throw new \Exception();
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('informasi', 'public');
        }

        // Upload & parsing PDF jika deskripsi kosong
        if (!$request->filled('deskripsi') && $request->hasFile('file_informasi')) {
            $file = $request->file('file_informasi');
            $parser = new PdfParser();
            $pdf = $parser->parseFile($file->getPathname());
            $data['deskripsi'] = $pdf->getText();
            $data['file_informasi'] = $file->store('file_informasi', 'public');
        } elseif ($request->hasFile('file_informasi')) {
            $data['file_informasi'] = $request->file('file_informasi')->store('file_informasi', 'public');
        }

        if (empty($data['deskripsi'])) {
            $data['deskripsi'] = '-';
        }

        Informasi::create($data);

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

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_informasi' => 'nullable|mimes:pdf|max:10240',
            'tanggal' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        // Format tanggal
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) throw new \Exception();
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        // Ganti foto
        if ($request->hasFile('foto')) {
            if ($informasi->foto && Storage::disk('public')->exists($informasi->foto)) {
                Storage::disk('public')->delete($informasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('informasi', 'public');
        }

        // Ganti file PDF
        if ($request->hasFile('file_informasi')) {
            if ($informasi->file_informasi && Storage::disk('public')->exists($informasi->file_informasi)) {
                Storage::disk('public')->delete($informasi->file_informasi);
            }

            $file = $request->file('file_informasi');

            if (!$request->filled('deskripsi')) {
                $parser = new PdfParser();
                $pdf = $parser->parseFile($file->getPathname());
                $data['deskripsi'] = $pdf->getText();
            }

            $data['file_informasi'] = $file->store('file_informasi', 'public');
        }

        if (empty($data['deskripsi'])) {
            $data['deskripsi'] = '-';
        }

        $informasi->update($data);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->foto && Storage::disk('public')->exists($informasi->foto)) {
            Storage::disk('public')->delete($informasi->foto);
        }

        if ($informasi->file_informasi && Storage::disk('public')->exists($informasi->file_informasi)) {
            Storage::disk('public')->delete($informasi->file_informasi);
        }

        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
