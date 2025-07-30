cb.blade.php :

<x-app-layout>
    <div class="py-10 px-4">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Tambah Berita</h2>

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul berita">
                </div>

                {{-- Isi Berita --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Isi Berita (Opsional)</label>
                    <textarea name="isi_berita" rows="5"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        placeholder="Tulis isi berita di sini..."></textarea>
                </div>

                {{-- Upload File Word/PDF --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" name="file_berita" accept=".pdf,.docx"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="text-gray-300 italic">Kosongkan isi berita jika menggunakan file</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="date" name="tanggal"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                </div>

                {{-- Foto --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Foto</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('berita.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
