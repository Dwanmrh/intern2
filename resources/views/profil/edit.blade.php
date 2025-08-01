<x-app-layout>

    @section('title', 'Edit Pimpinan | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Edit Pimpinan</h2>

            <form action="{{ route('profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ $profil->nama }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        placeholder="Masukkan nama pimpinan"
                        required>
                </div>

                {{-- Jabatan --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ $profil->jabatan }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        placeholder="Masukkan jabatan"
                        required>
                </div>

                {{-- Foto Lama --}}
                @if ($profil->foto)
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $profil->foto) }}" class="h-40 rounded shadow-md border border-white/20">
                    </div>
                @endif

                {{-- Ganti Foto --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition" />
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('profil.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
