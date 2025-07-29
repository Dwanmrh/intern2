<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Profil::all();
        return view('profil', compact('data'));
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
        return redirect()->route('profil.index')->with('success', 'Pimpinan berhasil ditambahkan');
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

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_pimpinan', 'public');
        }

        $profil->update($validated);
        return redirect()->route('profil.index')->with('success', 'Pimpinan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Pimpinan berhasil dihapus');
    }
}
