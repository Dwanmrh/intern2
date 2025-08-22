<x-app-layout>

    @section('title', 'Edit Informasi | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-8">Edit Informasi</h2>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $informasi->judul }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan judul informasi" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        placeholder="Masukkan deskripsi">{{ $informasi->deskripsi }}</textarea>
                    <small class="font-bold text-yellow-400 italic">Kosongkan jika menggunakan file</small>
                </div>

                {{-- File Sebelumnya --}}
                @if ($informasi->file_informasi)
                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-1">File Informasi Saat Ini</label>

                        {{-- Link lihat file --}}
                        <a href="{{ asset('storage/' . $informasi->file_informasi) }}" target="_blank"
                            class="text-blue-300 underline hover:text-blue-400 transition">Lihat File</a>

                        {{-- Checkbox hapus file --}}
                        <div class="mt-2">
                            <input type="checkbox" name="hapus_file" id="hapus_file" value="1"
                                class="mr-1 rounded border-gray-500">
                            <label for="hapus_file" class="text-red-300 font-medium">Hapus file ini</label>
                        </div>
                    </div>
                @endif

                {{-- Upload File Baru --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" name="file_informasi" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">Kosongkan jika memasukkan deskripsi</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        value="{{ $informasi->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- Foto Lama --}}
                @if ($informasi->foto)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $informasi->foto) }}" class="w-40 rounded-md shadow-md mb-2">

                        {{-- Checkbox Hapus Foto Lama --}}
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="hapusFoto" name="hapus_foto" value="1"
                                class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <label for="hapusFoto" class="text-white text-sm">Hapus foto lama</label>
                        </div>
                    </div>
                @endif

                {{-- Ganti Foto --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" id="fotoInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">

                    {{-- Preview Foto Baru --}}
                    <div id="previewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview Foto Baru:</p>
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

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('informasi.index') }}"
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
