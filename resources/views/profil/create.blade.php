<x-app-layout>

    @section('title', 'Tambah Pimpinan | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Pimpinan</h2>

            <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="nama"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Masukkan nama pimpinan">
                </div>

                {{-- Jabatan --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Jabatan</label>
                    <input type="text" name="jabatan"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Masukkan jabatan">
                </div>

                {{-- Foto --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition" />
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('profil.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
