<x-app-layout>
    @section('title', 'EDIT BERITA | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-8">Edit Berita</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $berita->judul }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Masukkan judul berita">
                </div>

                {{-- Berita --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Berita</label>
                    <textarea name="isi_berita"
                              class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                     focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                              placeholder="Masukkan isi berita">{{ $berita->isi_berita }}</textarea>
                    <small class="font-bold text-yellow-400 italic">Kosongkan isi berita jika menggunakan file</small>
                </div>

                {{-- File Sebelumnya --}}
                @if ($berita->file_berita)
                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-1">File Berita Saat Ini</label>

                        {{-- Link lihat file --}}
                        <a href="{{ asset('storage/' . $berita->file_berita) }}" target="_blank"
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
                    <input type="file" name="file_berita" accept=".pdf"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">Kosongkan upload file jika memasukkan isi berita | Max File 15 MB</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                           value="{{ $berita->tanggal }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Format: DD/MM/YYYY">
                    <small class="font-bold text-yellow-400 italic">Tanggal Wajib Diisi</small>
                </div>

                {{-- Foto Lama --}}
                @if ($berita->foto)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $berita->foto) }}" class="w-40 rounded-md shadow-md mb-2">

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
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2
                                  shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <small class="font-bold text-yellow-400 italic">Max Size 23 MB</small>

                    {{-- Preview Foto Baru --}}
                    <div id="previewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview Foto Baru:</p>
                        <img id="fotoPreview" src="" alt="Preview Foto" class="w-40 rounded-md shadow-md">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md
                                   shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>

                    <a href="{{ route('berita.index') }}"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md
                              shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <script>
        // Flatpickr initialization
        flatpickr("#tanggal", {
            dateFormat: "d/m/Y",
            locale: "id",
        });

        // Foto preview functionality
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
</x-app-layout>