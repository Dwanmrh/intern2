<x-app-layout>

    @section('title', 'Edit Fasilitas | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Edit Fasilitas</h2>

            <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $fasilitas->judul }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan judul fasilitas"
                        required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi" value="{{ $fasilitas->deskripsi }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan deskripsi"
                        required>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="umum" {{ $fasilitas->kategori === 'umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                        <option value="belajar" {{ $fasilitas->kategori === 'belajar' ? 'selected' : '' }}>Fasilitas Belajar</option>
                        <option value="khusus" {{ $fasilitas->kategori === 'khusus' ? 'selected' : '' }}>Fasilitas Khusus</option>
                    </select>
                </div>

                {{-- Subkategori --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Subkategori</label>
                    <select name="subKategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner"
                        required>
                        <option value="">-- Pilih Subkategori --</option>
                        <option value="Tempat Ibadah" {{ $fasilitas->subKategori === 'Tempat Ibadah' ? 'selected' : '' }}>Tempat Ibadah</option>
                        <option value="Tempat Olahraga" {{ $fasilitas->subKategori === 'Tempat Olahraga' ? 'selected' : '' }}>Tempat Olahraga</option>
                        <option value="Ruang Kelas" {{ $fasilitas->subKategori === 'Ruang Kelas' ? 'selected' : '' }}>Ruang Kelas</option>
                        <option value="Kantor" {{ $fasilitas->subKategori === 'Kantor' ? 'selected' : '' }}>Kantor</option>
                        <option value="Barak" {{ $fasilitas->subKategori === 'Barak' ? 'selected' : '' }}>Barak</option>
                        <option value="Gedung" {{ $fasilitas->subKategori === 'Gedung' ? 'selected' : '' }}>Gedung</option>
                        <option value="Lapangan Apel" {{ $fasilitas->subKategori === 'Lapangan Apel' ? 'selected' : '' }}>Lapangan Apel</option>
                        <option value="Lainnya" {{ $fasilitas->subKategori === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        value="{{ $fasilitas->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- Foto Lama --}}
                @if ($fasilitas->foto)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $fasilitas->foto) }}" class="h-40 rounded shadow-md">
                    </div>
                @endif

                {{-- Ganti Foto --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('fasilitas.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
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
