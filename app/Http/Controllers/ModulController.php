<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
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

        // 🔎 Filter Periode
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
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

        // Ambil semua pilihan Tahun & Periode untuk dropdown
        $allTahun = Modul::select('tahun')->distinct()->pluck('tahun');
        $allPeriode = Modul::select('periode')->distinct()->pluck('periode');

        return view('modul', compact('moduls', 'allTahun', 'allPeriode'));
    }

    public function sip(Request $request)
    {
        $query = Modul::query()->where('prodiklat', 'SIP'); // ✅ hanya SIP

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        $moduls = $query->get();
        $allTahun = Modul::where('prodiklat', 'SIP')->select('tahun')->distinct()->pluck('tahun');
        $allPeriode = Modul::where('prodiklat', 'SIP')->select('periode')->distinct()->pluck('periode');

        return view('modul.sip', compact('moduls', 'allTahun', 'allPeriode'));
    }

    public function pag(Request $request)
    {
        $query = Modul::query()->where('prodiklat', 'PAG'); // ✅ hanya PAG

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        $moduls = $query->get();
        $allTahun = Modul::where('prodiklat', 'PAG')->select('tahun')->distinct()->pluck('tahun');
        $allPeriode = Modul::where('prodiklat', 'PAG')->select('periode')->distinct()->pluck('periode');

        return view('modul.pag', compact('moduls', 'allTahun', 'allPeriode'));
    }

    public function create()
    {
        return view('modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string',
            'file'      => 'required|mimes:pdf|max:2048',
            'deskripsi' => 'nullable|string',
            'prodiklat' => 'required|string',
            'periode'   => 'required|string',
            'mapel'     => 'nullable|string',
            'tahun'     => 'nullable|digits:4',
        ]);

        $path = $request->file('file')->store('moduls', 'public');

        $modul = Modul::create([
            'judul'     => $request->judul,
            'file'      => $path,
            'deskripsi' => $request->deskripsi,
            'prodiklat' => $request->prodiklat,
            'periode'   => $request->periode,
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
        return view('modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'judul'     => 'required|string',
            'file'      => 'nullable|mimes:pdf|max:2048',
            'deskripsi' => 'nullable|string',
            'prodiklat' => 'nullable|string',
            'periode'   => 'nullable|string',
            'mapel'     => 'nullable|string',
            'tahun'     => 'nullable|digits:4',
        ]);

        $data = $request->only([
            'judul','deskripsi','prodiklat','periode','mapel','tahun'
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($modul->file);
            $path = $request->file('file')->store('moduls', 'public');
            $data['file'] = $path;
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
        // Hapus file
        Storage::disk('public')->delete($modul->file);

        // Simpan dulu prodiklat sebelum delete
        $prodiklat = $modul->prodiklat;

        // Hapus data modul
        $modul->delete();

        // 🔙 Redirect sesuai prodiklat
        if ($prodiklat === "SIP") {
            return redirect()->route('modul.sip')->with('success','Modul berhasil dihapus.');
        } elseif ($prodiklat === "PAG") {
            return redirect()->route('modul.pag')->with('success','Modul berhasil dihapus.');
        }

        return redirect()->route('modul.index')->with('success','Modul berhasil dihapus.');
    }
}
