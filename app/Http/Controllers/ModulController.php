<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        $query = Modul::query();

        // 🔎 Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // 🔎 Pencarian judul / deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Ambil data modul hasil filter
        $moduls = $query->orderBy('mapel')->get();

        // Ambil semua pilihan Tahun untuk dropdown
        $allTahun = Modul::select('tahun')->distinct()->pluck('tahun');

        return view('modul', compact('moduls', 'allTahun'));
    }

    public function sip(Request $request)
    {
        $query = Modul::query()->where('prodiklat', 'SIP'); // ✅ hanya SIP

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $moduls = $query->get();
        $allTahun = Modul::where('prodiklat', 'SIP')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('modul.sip', compact('moduls', 'allTahun'));
    }

    public function pag(Request $request)
    {
        $query = Modul::query()->where('prodiklat', 'PAG'); // ✅ hanya PAG

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $moduls = $query->get();
        $allTahun = Modul::where('prodiklat', 'PAG')
            ->select('tahun')
            ->distinct()
            ->pluck('tahun');

        return view('modul.pag', compact('moduls', 'allTahun'));
    }

    public function create(Request $request)
    {
        // 🚫 Batasi hanya admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $prodiklat = $request->get('prodiklat'); // bisa null kalau tidak ada
        return view('modul.create', compact('prodiklat'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul'     => 'required|string',
            'file'      => 'required|mimes:pdf|max:20000',
            'deskripsi' => 'nullable|string',
            'prodiklat' => 'required|string',
            'mapel'     => 'nullable|string',
            'tahun'     => 'nullable|digits:4',
        ]);

        $path = $request->file('file')->store('moduls', 'public');

        Modul::create([
            'judul'     => $request->judul,
            'file'      => $path,
            'deskripsi' => $request->deskripsi,
            'prodiklat' => $request->prodiklat,
            'mapel'     => $request->mapel,
            'tahun'     => $request->tahun,
        ]);

        // Redirect sesuai prodiklat
        if ($request->prodiklat === "SIP") {
            return redirect()->route('modul.sip')->with('success', 'Modul berhasil ditambahkan.');
        } elseif ($request->prodiklat === "PAG") {
            return redirect()->route('modul.pag')->with('success', 'Modul berhasil ditambahkan.');
        }

        return redirect()->route('modul.index')->with('success','Modul berhasil ditambahkan.');
    }

    public function show(Modul $modul)
    {
        return view('modul.show', compact('modul'));
    }

    public function edit(Modul $modul)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul'     => 'required|string',
            'file'      => 'nullable|mimes:pdf|max:20000',
            'deskripsi' => 'nullable|string',
            'prodiklat' => 'nullable|string',
            'mapel'     => 'nullable|string',
            'tahun'     => 'nullable|digits:4',
        ]);

        $data = $request->only([
            'judul','deskripsi','prodiklat','mapel','tahun'
        ]);

        // ✅ Jika user upload file baru
        if ($request->hasFile('file')) {
            if ($modul->file) {
                Storage::disk('public')->delete($modul->file);
            }
            $path = $request->file('file')->store('moduls', 'public');
            $data['file'] = $path;
        }
        // ✅ Jika user centang "hapus file ini"
        elseif ($request->filled('hapus_file')) {
            if ($modul->file) {
                Storage::disk('public')->delete($modul->file);
            }
            $data['file'] = null;
        }

        $modul->update($data);

        // 🔙 Redirect sesuai prodiklat
        if ($modul->prodiklat === "SIP") {
            return redirect()->route('modul.sip')->with('success', 'Modul berhasil diperbarui.');
        } elseif ($modul->prodiklat === "PAG") {
            return redirect()->route('modul.pag')->with('success', 'Modul berhasil diperbarui.');
        }

        return redirect()->route('modul.index')->with('success','Modul berhasil diperbarui.');
    }

    public function destroy(Modul $modul)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // ✅ Hapus file kalau ada
        if ($modul->file) {
            Storage::disk('public')->delete($modul->file);
        }

        $prodiklat = $modul->prodiklat;
        $modul->delete();

        if ($prodiklat === "SIP") {
            return redirect()->route('modul.sip')->with('success','Modul berhasil dihapus.');
        } elseif ($prodiklat === "PAG") {
            return redirect()->route('modul.pag')->with('success','Modul berhasil dihapus.');
        }

        return redirect()->route('modul.index')->with('success','Modul berhasil dihapus.');
    }
}
