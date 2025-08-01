<x-app-layout>

    @section('title', 'Edit Berita | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Edit Berita</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-4 py-2 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $berita->judul }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul berita">
                </div>

                {{-- Isi Berita --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Isi Berita</label>
                    <textarea name="isi_berita" rows="5"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        placeholder="Masukkan isi berita">{{ $berita->isi_berita }}</textarea>
                    <small class="font-bold text-yellow-400 italic">Kosongkan isi berita jika menggunakan file</small>
                </div>

                {{-- File Sebelumnya --}}
                @if ($berita->file_berita)
                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-1">File Berita Saat Ini</label>
                        <a href="{{ asset('storage/' . $berita->file_berita) }}" target="_blank"
                            class="text-blue-300 underline hover:text-blue-400 transition">Lihat File</a>
                    </div>
                @endif

                {{-- Upload File Baru --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Upload File Berita (PDF)</label>
                    <input type="file" name="file_berita" accept=".pdf,.docx"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">Kosongkan upload file jika memasukkan isi berita</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        value="{{ $berita->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- Foto Lama --}}
                @if ($berita->foto)
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $berita->foto) }}" class="h-40 rounded shadow-lg">
                    </div>
                @endif

                {{-- Ganti Foto --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Ganti Foto (Opsional)</label>
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
                        Perbarui
                    </button>
                </div>
            </form>

            {{-- Flatpickr --}}
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
            <script>
                flatpickr("#tanggal", {
                    dateFormat: "d/m/Y",
                    locale: "id",
                });
            </script>
        </div>
    </div>
</x-app-layout>
