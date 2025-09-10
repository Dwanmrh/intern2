<x-app-layout>
    @section('title', 'TAMBAH JADWAL | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Jadwal</h2>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" id="judulInput" name="judul"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        placeholder="Kosongkan jika ingin pakai nama file PDF">
                    <small class="font-bold text-yellow-400 italic">Kosongkan jika ingin otomatis pakai nama file</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                    <small class="font-bold text-yellow-400 italic">Tanggal Wajib Diisi</small>
                </div>

                {{-- Upload File PDF --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" id="fileInput" name="file" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition" required>
                    <small class="font-bold text-yellow-400 italic">Wajib diisi | Max Size 15 MB</small>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>

                    <a href="{{ route('informasi.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                </div>
            </form>

            {{-- Script Auto Judul --}}
            <script>
                document.getElementById('fileInput').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    const judulInput = document.getElementById('judulInput');

                    if (file && file.name.endsWith('.pdf') && judulInput.value.trim() === '') {
                        let namaFile = file.name.replace(/\.pdf$/i, '');
                        namaFile = namaFile.replace(/[_-]+/g, ' ').trim();
                        try { namaFile = decodeURIComponent(namaFile); } catch (e) {}
                        judulInput.value = namaFile;
                    }
                });
            </script>

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
