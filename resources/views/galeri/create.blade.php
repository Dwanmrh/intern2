<x-app-layout>

    @section('title', 'TAMBAH KONTEN | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Konten</h2>

            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan judul konten" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan deskripsi konten" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                    <small class="font-bold text-yellow-400 italic">Tanggal Wajib Diisi</small>
                </div>

                {{-- Foto --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload Foto</label>
                    <input type="file" name="foto" id="fotoInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">

                    {{-- Preview --}}
                    <div id="previewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview:</p>
                        <img id="fotoPreview" src="" alt="Preview Foto" class="w-40 rounded-md shadow-md">
                    </div>
                </div>

                <script>
                    document.getElementById('fotoInput').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const previewContainer = document.getElementById('previewContainer');
                        const fotoPreview = document.getElementById('fotoPreview');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                fotoPreview.src = e.target.result;
                                previewContainer.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else {
                            fotoPreview.src = "";
                            previewContainer.classList.add('hidden');
                        }
                    });
                </script>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('galeri.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
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
