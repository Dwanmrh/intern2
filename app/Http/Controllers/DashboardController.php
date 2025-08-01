<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Menampilkan daftar preview dashboard
    public function index()
    {
         $dashboards = Dashboard::latest()->get();
         $beritas = Berita::orderBy('tanggal', 'desc')->take(4)->get();
         $galeris = Galeri::orderBy('tanggal', 'desc')->take(4)->get();

        return view('dashboard', compact('dashboards', 'beritas', 'galeris'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('dashboard.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:10000',
        ]);

        $data = $request->only('judul', 'tanggal');

        // Ubah format tanggal dari d/m/Y ke Y-m-d buat di db
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Invalid date');
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        Dashboard::create($data);

        return redirect()->route('dashboard.index')->with('success', 'Preview berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $dashboard->tanggal = Carbon::parse($dashboard->tanggal)->format('d/m/Y');

        return view('dashboard.edit', compact('dashboard'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $dashboard = Dashboard::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:10000',
        ]);

        $data = $request->only('judul', 'tanggal');

        // Ubah format tanggal dari d/m/Y ke Y-m-d buat di db
        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            if ($tanggal->format('d/m/Y') !== $request->tanggal) {
                throw new \Exception('Invalid date');
            }
            $data['tanggal'] = $tanggal->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid'])->withInput();
        }

        $dashboard->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Preview berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        if ($dashboard->file && Storage::disk('public')->exists($dashboard->file)) {
            Storage::disk('public')->delete($dashboard->file);
        }

        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Preview berhasil dihapus.');
    }
}
