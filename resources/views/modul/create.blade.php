<x-app-layout>

    @section('title', 'TAMBAH MODUL | SETUKPA LEMDIKLAT POLRI')

    <div class="flex justify-center items-center min-h-screen bg-gray-200 pt-10">
        <div class="bg-[#2c3e50] w-full max-w-md rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-white mb-6">Tambah Modul</h2>

            <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan Judul Modul"
                        class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Masukkan Deskripsi Modul"
                              class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
                </div>

                {{-- Prodiklat --}}
                <div class="mb-4">
                    <label for="prodiklat" class="block text-white font-semibold mb-1">Prodiklat</label>
                    <select name="prodiklat" id="prodiklat" class="w-full rounded p-2">
                        <option value="SIP" {{ (old('prodiklat', $prodiklat ?? '') == 'SIP') ? 'selected' : '' }}>SIP</option>
                        <option value="PAG" {{ (old('prodiklat', $prodiklat ?? '') == 'PAG') ? 'selected' : '' }}>PAG</option>
                    </select>
                </div>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select id="mapel" name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                    </select>
                </div>

                <script>
                    const mapelsSIP = [
                        "Wawasan Kebangsaan",
                        "Etika dan Kode Etik Profesi Polri",
                        "Peraturan Pemerintah Nomor 1, 2, dan 3 Tahun 2003",
                        "Nilai Sejarah Polri",
                        "Integritas dan Budaya Anti Korupsi",
                        "Hukum Pidana dan Hukum Acara Pidana",
                        "Pengetahuan Tentang HAM",
                        "Diskresi & Restorative Justice",
                        "PPA dan ABH",
                        "Manajemen Training Level I",
                        "Kepemimpinan",
                        "Sistem, Manajemen dan Standar Keberhasilan Operasional Kepolisian",
                        "Sistem Pelayanan Kepolisian Terpadu",
                        "Manajemen Fungsi Intelkam",
                        "Manajemen Fungsi Binmas",
                        "Manajemen Fungsi Sabhara",
                        "Manajemen Fungsi Lantas",
                        "Manajemen Fungsi Reserse",
                        "Perencanaan dan Penganggaran Polri",
                        "Manajemen SDM Polri",
                        "Manajemen Logistik Polri",
                        "Keuangan Polri",
                        "Manajemen Tingkat Polsek",
                        "Community Policing",
                        "Democratic Policing",
                        "Predictive Policing",
                        "Pengetahuan Sosial",
                        "Pelayanan Prima",
                        "Manajemen Penanggulangan Bencana",
                        "Search and Rescue (SAR)",
                        "Identifikasi Kepolisian",
                        "Laboratorium Forensik Kedokteran Kepolisian",
                        "Tata Naskah Dinas di Lingkungan Polri",
                        "Tata Upacara dan Pedang Perwira",
                        "Penggunaan Senjata Api dan Menembak",
                        "Teknik Keselamatan dan Bela Diri Polri",
                        "Sistem Pelayanan Polri Berbasis Elektronik",
                        "Psikologi Sosial dan Teknik Dasar Konseling",
                        "Manajemen Kehumasan Polri",
                        "Teknologi Informasi Kepolisian",
                        "Pencegahan Kejahatan (Crime Prevention)",
                        "Gladi Wirottama",
                        "Porismas",
                        "Latihan Teknis/Latihan Kerja",
                        "Ujian Kompetensi Perwira Pertama",
                    ];

                    const mapelsPAG = [
                        "Pancasila dan Wawasan Kebangsaan",
                        "Etika dan Kode Etik Profesi Polri",
                        "Integritas dan Budaya Anti Korupsi",
                        "Peraturan Pemerintah Nomor 1, 2, dan 3 tahun 2003",
                        "Hukum Pidana dan Hukum Acara Pidana",
                        "Diskresi Kepolisian dan Restorative Justice",
                        "Hak Asasi Manusia (HAM)",
                        "PPA dan ABH",
                        "Kepemimpinan",
                        "Manajemen Pembinaan Polri",
                        "Manajemen Tingkat Polsek",
                        "Manajemen Training Level I",
                        "Sistem, Manajemen dan Standar Keberhasilan Operasional Polri",
                        "Tata Naskah Dinas di Lingkungan Polri",
                        "Tata Upacara dan Pedang Perwira",
                        "Pencegahan Kejahatan (Crime Prevention)",
                        "Manajemen Kehumasan Polri",
                        "Latihan Teknis",
                    ];

                    function loadMapels() {
                        const prodiklat = document.getElementById('prodiklat').value;
                        const mapelSelect = document.getElementById('mapel');
                        mapelSelect.innerHTML = '<option value="">-- Pilih Mapel --</option>';

                        const list = prodiklat === 'PAG' ? mapelsPAG : mapelsSIP;

                        list.forEach((m, i) => {
                            const opt = document.createElement('option');
                            opt.value = m;
                            opt.textContent = String(i + 1).padStart(2, '0') + ". " + m;
                            // restore pilihan lama jika ada
                            if ("{{ old('mapel') }}" === m) {
                                opt.selected = true;
                            }
                            mapelSelect.appendChild(opt);
                        });
                    }

                    // load saat halaman dibuka
                    loadMapels();

                    // ganti mapel setiap kali prodiklat diubah
                    document.getElementById('prodiklat').addEventListener('change', loadMapels);
                </script>

                {{-- Tahun --}}
                <div class="mb-4">
                    <label for="tahun" class="block text-white font-semibold mb-1">Tahun</label>
                    <input
                        type="text"
                        name="tahun"
                        id="tahun"
                        placeholder="Masukkan Tahun"
                        inputmode="numeric"
                        pattern="^[0-9]{4}$"
                        required
                        class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none peer"
                    >
                    <small class="font-bold text-yellow-400 italic">Tahun harus berupa 4 digit angka (Contoh: 2025)</small>
                </div>

                {{-- Upload File --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" id="file" name="file" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">Max Size 15 MB</small>
                </div>

                <script>
                    document.getElementById('file').addEventListener('change', function(e) {
                        let file = e.target.files[0];
                        if (file) {
                            // ambil nama file tanpa extension
                            let filename = file.name.replace(/\.[^/.]+$/, "");
                            document.getElementById('judul').value = filename;
                        }
                    });
                </script>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ url()->previous() ?? route('modul.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
