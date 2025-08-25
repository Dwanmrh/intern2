<!-- FASILITAS/CREATE.BLADE.PHP -->

<x-app-layout>

    @section('title', 'Tambah Fasilitas | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Fasilitas</h2>

            <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan judul fasilitas" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi" value="{{ old('deskripsi') }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan deskripsi fasilitas" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="belajar" {{ old('kategori') === 'belajar' ? 'selected' : '' }}>Fasilitas Belajar</option>
                        <option value="umum" {{ old('kategori') === 'umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                        <option value="khusus" {{ old('kategori') === 'khusus' ? 'selected' : '' }}>Fasilitas Khusus</option>
                    </select>
                </div>

                {{-- Subkategori --}}
                <div class="mb-3" id="subKategoriWrapper">
                    <label class="block text-white font-semibold mb-1">Subkategori</label>
                    <select name="subKategori" id="subKategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner"
                        required>
                        <option value="">-- Pilih Subkategori --</option>
                    </select>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const kategoriSelect = document.querySelector('select[name="kategori"]');
                        const subKategoriWrapper = document.getElementById('subKategoriWrapper');
                        const subKategoriSelect = document.getElementById('subKategori');

                        const options = {
                            umum: [
                                "Tempat Ibadah",
                                "Olahraga & Rekreasi",
                                "Kesehatan & Penunjang",
                                "Sejarah",
                                "Gedung Lain"
                            ],
                            belajar: [
                                "Ruang Kelas & Gedung",
                                "Lapangan Latihan"
                            ],
                            khusus: [
                                "Perkantoran",
                                "Barak Siswa",
                                "Rumah Dinas",
                                "Sarana Penunjang"
                            ]
                        };

                        // ✅ Ambil data lama dari old()
                        const oldSubKategori = @json(old('subKategori'));

                        function updateSubKategori() {
                            const kategori = kategoriSelect.value;
                            subKategoriSelect.innerHTML = '<option value="">-- Pilih Subkategori --</option>';

                            if (options[kategori] && options[kategori].length > 0) {
                                subKategoriWrapper.style.display = 'block';
                                options[kategori].forEach(opt => {
                                    let option = document.createElement('option');
                                    option.value = opt;
                                    option.textContent = opt;

                                    // ✅ Auto select old value
                                    if (opt === oldSubKategori) {
                                        option.selected = true;
                                    }

                                    subKategoriSelect.appendChild(option);
                                });
                            } else {
                                subKategoriWrapper.style.display = 'none';
                            }
                        }

                        kategoriSelect.addEventListener('change', updateSubKategori);
                        updateSubKategori(); // load awal
                    });
                </script>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- Foto --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Foto (Opsional)</label>
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
                    <a href="{{ url()->previous() ?? route('fasilitas.index') }}"
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
