<x-app-layout>

    @section('title', 'EDIT MODUL | SETUKPA LEMDIKLAT POLRI')

    <div class="flex justify-center items-center min-h-screen bg-gray-200 pt-10">
        <div class="bg-[#2c3e50] w-full max-w-md rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-white mb-6">Edit Modul</h2>

            <form action="{{ route('modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $modul->judul) }}"
                           class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('deskripsi', $modul->deskripsi) }}</textarea>
                </div>

                {{-- Prodiklat --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Prodiklat</label>
                    <select id="prodiklat" name="prodiklat"
                            class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Prodiklat --</option>
                        <option value="SIP" {{ old('prodiklat', $modul->prodiklat) == 'SIP' ? 'selected' : '' }}>SIP</option>
                        <option value="PAG" {{ old('prodiklat', $modul->prodiklat) == 'PAG' ? 'selected' : '' }}>PAG</option>
                    </select>
                </div>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                            @php
                                $mapels = [
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
                                    "Ujian Kompetensi Perwira Pertama"
                                ];
                            @endphp
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel }}" {{ old('mapel', $modul->mapel) == $mapel ? 'selected' : '' }}>
                                    {{ $mapel }}
                                </option>
                            @endforeach
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
                        value="{{ old('tahun', $modul->tahun) }}"
                        class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none peer"
                    >
                    <p class="mt-1 text-sm text-red-500 hidden peer-invalid:block">
                        Tahun harus berupa 4 digit angka (contoh: 2025)
                    </p>
                </div>

                {{-- Upload File (PDF) --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload File (PDF)</label>
                    <input type="file" name="file" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <small class="font-bold text-yellow-400 italic">Max Size 15 MB</small>

                    @if($modul->file)
                        <p class="text-sm mt-1">
                            <span class="text-white font-bold">File saat ini:</span>
                            <a href="{{ asset('storage/'.$modul->file) }}" target="_blank"
                            class="text-blue-400 italic underline hover:text-blue-500">
                                Lihat File
                            </a>
                        </p>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ url()->previous() ?? route('modul.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
