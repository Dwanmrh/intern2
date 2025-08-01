<x-app-layout>

    @section('title', 'Tambah Fasilitas | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Tambah Fasilitas</h2>

            <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan judul fasilitas" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan deskripsi" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- Foto --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Foto</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('fasilitas.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
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
