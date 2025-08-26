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
                    <input type="text" name="judul" placeholder="Masukan Judul Modul"
                           class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Masukan Deskripsi Modul"
                              class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
                </div>

                {{-- Prodiklat --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Prodiklat</label>
                    <select id="prodiklat" name="prodiklat"
                        class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Prodiklat --</option>
                        <option value="SIP">SIP</option>
                        <option value="PAG">PAG</option>
                    </select>
                </div>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                        <option value="Wawasan Kebangsaan">Wawasan Kebangsaan</option>
                        <option value="Etika Dan Kode Etik Profesi Polri">Etika Dan Kode Etik Profesi Polri</option>
                        <option value="Peraturan Pemerintah Nomor 1, 2, Dan 3 Tahun 2003">Peraturan Pemerintah Nomor 1, 2, Dan 3 Tahun 2003</option>
                        <option value="Nilai Sejarah Polri">Nilai Sejarah Polri</option>
                        <option value="Integritas Dan Budaya Anti Korupsi">Integritas Dan Budaya Anti Korupsi</option>
                        <option value="Hukum Pidana Dan Hukum Acara Pidana">Hukum Pidana Dan Hukum Acara Pidana</option>
                        <option value="Pengetahuan Tentang Ham">Pengetahuan Tentang Ham</option>
                        <option value="Diskresi & Restorative Justice">Diskresi & Restorative Justice</option>
                        <option value="PPA dan ABH">PPA dan ABH</option>
                        <option value="Manajemen Training Level I">Manajemen Training Level I</option>
                        <option value="Kepemimpinan">Kepemimpinan</option>
                        <option value="Sistem, Manajemen Dan Standar Keberhasilan Operasioanal Kepolisian">Sistem, Manajemen Dan Standar Keberhasilan Operasioanal Kepolisian</option>
                        <option value="Sistem Pelayanan Kepolisian Terpadu">Sistem Pelayanan Kepolisian Terpadu</option>
                        <option value="Manajemen Fungsi Intelkam">Manajemen Fungsi Intelkam</option>
                        <option value="Manajemen Fungsi Binmas">Manajemen Fungsi Binmas</option>
                        <option value="Manajemen Fungsi Sabhara">Manajemen Fungsi Sabhara</option>
                        <option value="Manajemen Fungsi Lantas">Manajemen Fungsi Lantas</option>
                        <option value="Manajemen Fungsi Reserse">Manajemen Fungsi Reserse</option>
                        <option value="Perencanaan Dan Penganggaran Polri">Perencanaan Dan Penganggaran Polri</option>
                        <option value="Manajemen Sdm Polri">Manajemen Sdm Polri</option>
                        <option value="Manajemen Logistik Polri">Manajemen Logistik Polri</option>
                        <option value="Keuangan Polri">Keuangan Polri</option>
                        <option value="Manajemen Tingkat Polsek">Manajemen Tingkat Polsek</option>
                        <option value="Community Policing">Community Policing</option>
                        <option value="Democtratic Policing">Democtratic Policing</option>
                        <option value="Predictive Policing">Predictive Policing</option>
                        <option value="Konflik Sosial">Konflik Sosial</option>
                        <option value="Komunikasi Sosial">Komunikasi Sosial</option>
                        <option value="Pelayanan Prima">Pelayanan Prima</option>
                        <option value="Manajemen Penanggulangan Bencana">Manajemen Penanggulangan Bencana</option>
                        <option value="Search and Rescue (SAR)">Search And Rescue (SAR)</option>
                        <option value="Identifikasi Kepolisian">Identifikasi Kepolisian</option>
                        <option value="Laboratorium Forensik Kedokteran Kepolisian">Komunikasi Sosial</option>
                        <option value="Tata Naskah Dinas Di Lingkungan Polri">Tata Naskah Dinas Di Lingkungan Polri</option>
                        <option value="Tata Upacara Dan Pedang Perwira">Tata Upacara Dan Pedang Perwira</option>
                        <option value="Penggunaan Senjata Api Dan Menembak">Penggunaan Senjata Api Dan Menembak</option>
                        <option value="Teknik Keselamatan Dan Bela Diri Polri">Teknik Keselamatan Dan Bela Diri Polri</option>
                        <option value="Sistem Pelayanan Polri Berbasis Elektronik">Sistem Pelayanan Polri Berbasis Elektronik</option>
                        <option value="Psikologi Sosial Dan Teknik Dasar Konseling">Psikologi Sosial Dan Teknik Dasar Konseling</option>
                        <option value="Manajemen Kehumasan Polri">Manajemen Kehumasan Polri</option>
                        <option value="Teknologi Informasi Kepolisian">Teknologi Informasi Kepolisian</option>
                        <option value="Pencegahan Kejahatan (Crime Prevention)">Pencegahan Kejahatan (Crime Prevention)</option>
                        <option value="Gladi Wirottama">Gladi Wirottama</option>
                        <option value="Porismas">Porismas</option>
                        <option value="Latihan Teknis/Latihan Kerja">Latihan Teknis/Latihan Kerja</option>
                        <option value="Ujian Kompetensi Perwira Pertama">Komunikasi Sosial</option>
                    </select>
                </div>

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
                    <p class="mt-1 text-sm text-red-500 hidden peer-invalid:block">
                        Tahun harus berupa 4 digit angka (contoh: 2025)
                    </p>
                </div>

                {{-- Upload File Word/PDF --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" name="file" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                </div>

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