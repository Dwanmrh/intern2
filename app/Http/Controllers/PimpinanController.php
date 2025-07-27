<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pimpinan;

class PimpinanController extends Controller
{
    public function index()
    {
        $data = Pimpinan::all();
        return view('profil', compact('data'));
    }

    public function create()
    {
        return view('profil.add-profil');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_pimpinan', 'public');
        }

        Pimpinan::create($validated);
        return redirect()->route('profil')->with('success', 'Pimpinan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        return view('profil.edit-profil', compact('pimpinan'));
    }

    public function update(Request $request, $id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_pimpinan', 'public');
        }

        $pimpinan->update($validated);
        return redirect()->route('profil')->with('success', 'Pimpinan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        $pimpinan->delete();
        return redirect()->route('profil')->with('success', 'Pimpinan berhasil dihapus');
    }
}
