<x-app-layout>
    @section('title', 'EDIT JADWAL | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div
            class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-8">Edit Jadwal</h2>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" id="judulInput"
                        value="{{ old('judul', $jadwal->judul) }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required placeholder="Kosongkan jika ingin otomatis dari nama file">
                    <small class="font-bold text-yellow-400 italic">Kosongkan jika ingin otomatis dari nama file</small>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        value="{{ old('tanggal', \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y')) }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- File Lama --}}
                @if ($jadwal->file)
                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-1">File Saat Ini</label>

                        {{-- Link lihat file --}}
                        <a href="{{ asset('storage/' . $jadwal->file) }}" target="_blank"
                            class="text-blue-300 underline hover:text-blue-400 transition">Lihat File</a>

                        {{-- Checkbox hapus file --}}
                        <div class="mt-2 flex items-center bg-red-600/20 px-3 py-2 rounded-lg">
                            <input type="checkbox" name="hapus_file" id="hapus_file" value="1"
                                class="mr-2 h-4 w-4 rounded text-red-600 border-red-300 focus:ring-red-500 cursor-pointer">
                            <label for="hapus_file" class="text-red-500 font-semibold hover:text-red-400 transition cursor-pointer">
                                Hapus file ini
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Upload File Baru --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" name="file" id="fileInput" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">
                        Kosongkan jika tidak ingin mengganti | Max Size 15 MB
                    </small>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>

                    <a href="{{ route('informasi.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                </div>
            </form>

            {{-- Script: auto-fill judul dari nama file --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const fileInput = document.getElementById('fileInput');
                    const judulInput = document.getElementById('judulInput');

                    if (fileInput) {
                        fileInput.addEventListener('change', function (event) {
                            const file = event.target.files && event.target.files[0];
                            if (!file) return;

                            let name = file.name.replace(/\.[^/.]+$/, "");
                            name = name.replace(/[_-]+/g, ' ').trim();
                            try { name = decodeURIComponent(name); } catch (e) {}

                            if (judulInput) {
                                judulInput.value = name;
                            }
                        });
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
