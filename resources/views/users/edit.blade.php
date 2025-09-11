<x-app-layout>
    @section('title', 'EDIT USER | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-6 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Edit User</h2>

            {{-- Error --}}
            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Masukkan nama user">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Masukkan email">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Password (isi jika ingin ganti)</label>
                    <input type="password" name="password"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           placeholder="Kosongkan jika tidak diganti">
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           placeholder="Ulangi password jika diganti">
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Role</label>
                    <select name="role"
                            class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                   focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="personel" {{ $user->role == 'personel' ? 'selected' : '' }}>Personel</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md
                                   shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md
                              shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
