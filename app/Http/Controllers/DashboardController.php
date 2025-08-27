<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Berita;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Menampilkan halaman HOME
    public function index()
    {
        $dashboards = Dashboard::latest()->get();
        $beritas = Berita::orderBy('tanggal', 'desc')->take(4)->get();
        $links = Link::all(); // ambil semua link terkait

        return view('dashboard', compact('dashboards', 'beritas', 'links'));
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
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:40000',
        ]);

        $data = $request->only('judul', 'tanggal');

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

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('dashboard', 'public');
            $data['file'] = $filePath;
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
            'tanggal' => 'required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,webm|max:40000',
        ]);

        $data = $request->only('judul', 'tanggal');

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

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($dashboard->file && Storage::disk('public')->exists($dashboard->file)) {
                Storage::disk('public')->delete($dashboard->file);
            }

            $filePath = $request->file('file')->store('dashboard', 'public');
            $data['file'] = $filePath;
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
