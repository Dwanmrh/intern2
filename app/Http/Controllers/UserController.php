<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user + filter + search
    public function index(Request $request)
    {
        // hanya super_admin yang bisa akses manage users
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Urutkan role lalu nama
        $users = $query->orderByRaw("
            FIELD(role, 'super_admin', 'admin', 'personel', 'siswa')
        ")->orderBy('name', 'asc')->get();

        return view('users', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|string|in:siswa,personel,admin,super_admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|string|in:siswa,personel,admin,super_admin',
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    // Hapus semua user kecuali yang login
    public function destroyAll()
    {
        $currentUserId = auth()->id();

        User::where('id', '!=', $currentUserId)->delete();

        return redirect()->route('users.index')->with('success', 'Semua user berhasil dihapus kecuali akun Anda sendiri.');
    }
}
