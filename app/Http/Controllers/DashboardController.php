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
    public function index()
    {
        $dashboards = Dashboard::latest()->get();
        $beritas = Berita::orderBy('tanggal', 'desc')->take(4)->get();
        $links = Link::all(); // ambil semua link terkait

        return view('dashboard', compact('dashboards', 'beritas', 'links'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

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

    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $dashboard->tanggal = Carbon::parse($dashboard->tanggal)->format('d/m/Y');

        return view('dashboard.edit', compact('dashboard'));
    }

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

    public function destroy($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        if ($dashboard->file && Storage::disk('public')->exists($dashboard->file)) {
            Storage::disk('public')->delete($dashboard->file);
        }

        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Preview berhasil dihapus.');
    }

    // === CRUD LINK DI DASHBOARD ===
    public function linkCreate()
    {
        return view('dashboard.link-create');
    }

    public function linkStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:15000',
        ]);

        $data = $request->only('nama', 'url');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('links', 'public');
        }

        Link::create($data);

        return redirect()->route('dashboard.index')->with('success', 'Link berhasil ditambahkan.');
    }

    public function linkEdit($id)
    {
        $link = Link::findOrFail($id);
        return view('dashboard.link-edit', compact('link'));
    }

    public function linkUpdate(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:15000',
        ]);

        $data = $request->only('nama', 'url');

        if ($request->hasFile('logo')) {
            if ($link->logo && Storage::disk('public')->exists($link->logo)) {
                Storage::disk('public')->delete($link->logo);
            }
            $data['logo'] = $request->file('logo')->store('links', 'public');
        }

        $link->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Link berhasil diperbarui.');
    }

    public function linkDestroy($id)
    {
        $link = Link::findOrFail($id);

        if ($link->logo && Storage::disk('public')->exists($link->logo)) {
            Storage::disk('public')->delete($link->logo);
        }

        $link->delete();

        return redirect()->route('dashboard.index')->with('success', 'Link berhasil dihapus.');
    }

}
