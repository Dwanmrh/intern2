<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date_format:d/m/Y',
            'file'    => 'required|mimes:pdf,doc,docx,xlsx|max:20480',
        ]);

        // Format tanggal ke Y-m-d
        $tanggal = Carbon::createFromFormat('d/m/Y', trim($request->tanggal))->format('Y-m-d');

        // Simpan file ke storage/app/public/jadwal
        $filePath = $request->file('file')->store('jadwal', 'public');

        Jadwal::create([
            'judul'   => $request->judul,
            'tanggal' => $tanggal,
            'file'    => $filePath,
        ]);

        return redirect()->route('informasi.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date_format:d/m/Y',
            'file'    => 'nullable|mimes:pdf,doc,docx,xlsx|max:20480',
        ]);

        $tanggal = Carbon::createFromFormat('d/m/Y', trim($request->tanggal))->format('Y-m-d');

        $data = [
            'judul'   => $request->judul,
            'tanggal' => $tanggal,
        ];

        // Jika ada file baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('file')) {
            if ($jadwal->file && Storage::disk('public')->exists($jadwal->file)) {
                Storage::disk('public')->delete($jadwal->file);
            }
            $data['file'] = $request->file('file')->store('jadwal', 'public');
        }

        $jadwal->update($data);

        return redirect()->route('informasi.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->file && Storage::disk('public')->exists($jadwal->file)) {
            Storage::disk('public')->delete($jadwal->file);
        }

        $jadwal->delete();

        return redirect()->route('informasi.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
