<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function index()
    {
         $data = Profil::all();

        $kasetukpa = $data->first(function ($item) {
            return strtolower($item->jabatan) === 'kasetukpa';
        });

        $wakasetukpa = $data->first(function ($item) {
            return strtolower($item->jabatan) === 'wakasetukpa';
        });

        $pimpinanLain = $data->filter(function ($item) {
            return !in_array(strtolower($item->jabatan), ['kasetukpa', 'wakasetukpa']);
        });

        return view('profil', compact('kasetukpa', 'wakasetukpa', 'pimpinanLain'));
    }

    public function create()
    {
        return view('profil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_pimpinan', 'public');
        }

        Profil::create($validated);
        return redirect()->route('profil.index')->with('success', 'Personel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profil = Profil::findOrFail($id);
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Jika hapus foto dicentang
        if ($request->has('hapus_foto') && $profil->foto) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $profil->foto);
            $profil->foto = null;
        }

        // Jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($profil->foto) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $profil->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_pimpinan', 'public');
            $profil->foto = $validated['foto'];
        }

        // Update field lain
        $profil->nama = $validated['nama'];
        $profil->jabatan = $validated['jabatan'];

        $profil->save();

        return redirect()->route('profil.index')->with('success', 'Personel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Personel berhasil dihapus');
    }
}
