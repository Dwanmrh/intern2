<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Menampilkan daftar preview dashboard
    public function index()
    {
         $dashboards = Dashboard::latest()->get();
         $beritas = Berita::latest()->take(4)->get();
         $galeris = Galeri::latest()->take(4)->get();
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
            'tanggal' => 'required|date',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:10240', // max 10MB
        ]);

        $data = $request->only('judul', 'tanggal');

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('dashboard', 'public');
        }

        Dashboard::create($data);

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        return view('dashboard.edit', compact('dashboard'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $dashboard = Dashboard::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:10240',
        ]);

        $data = $request->only('judul', 'tanggal');

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($dashboard->file && Storage::disk('public')->exists($dashboard->file)) {
                Storage::disk('public')->delete($dashboard->file);
            }

            $data['file'] = $request->file('file')->store('dashboard', 'public');
        }

        $dashboard->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        if ($dashboard->file && Storage::disk('public')->exists($dashboard->file)) {
            Storage::disk('public')->delete($dashboard->file);
        }

        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil dihapus.');
    }
}
