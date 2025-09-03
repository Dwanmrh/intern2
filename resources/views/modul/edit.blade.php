<x-app-layout>

    @section('title', 'EDIT MODUL | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-8">Edit Modul</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $modul->judul) }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul modul">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        placeholder="Masukkan deskripsi modul">{{ old('deskripsi', $modul->deskripsi) }}</textarea>
                </div>

                {{-- Prodiklat --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Prodiklat</label>
                    <select name="prodiklat"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="">-- Pilih Prodiklat --</option>
                        <option value="SIP" {{ old('prodiklat', $modul->prodiklat) == 'SIP' ? 'selected' : '' }}>SIP</option>
                        <option value="PAG" {{ old('prodiklat', $modul->prodiklat) == 'PAG' ? 'selected' : '' }}>PAG</option>
                    </select>
                </div>

                {{-- Mapel --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select name="mapel"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="">-- Pilih Mapel --</option>
                        @php
                            $mapels = [
                                "Wawasan Kebangsaan", "Etika dan Kode Etik Profesi Polri",
                                "Peraturan Pemerintah Nomor 1, 2, dan 3 Tahun 2003",
                                "Nilai Sejarah Polri", "Integritas dan Budaya Anti Korupsi",
                                "Hukum Pidana dan Hukum Acara Pidana", "Pengetahuan Tentang HAM",
                                "Diskresi & Restorative Justice", "PPA dan ABH",
                                "Manajemen Training Level I", "Kepemimpinan",
                                "Sistem, Manajemen dan Standar Keberhasilan Operasional Kepolisian",
                                "Sistem Pelayanan Kepolisian Terpadu", "Manajemen Fungsi Intelkam",
                                "Manajemen Fungsi Binmas", "Manajemen Fungsi Sabhara",
                                "Manajemen Fungsi Lantas", "Manajemen Fungsi Reserse",
                                "Perencanaan dan Penganggaran Polri", "Manajemen SDM Polri",
                                "Manajemen Logistik Polri", "Keuangan Polri",
                                "Manajemen Tingkat Polsek", "Community Policing",
                                "Democratic Policing", "Predictive Policing", "Pengetahuan Sosial",
                                "Pelayanan Prima", "Manajemen Penanggulangan Bencana",
                                "Search and Rescue (SAR)", "Identifikasi Kepolisian",
                                "Laboratorium Forensik Kedokteran Kepolisian",
                                "Tata Naskah Dinas di Lingkungan Polri", "Tata Upacara dan Pedang Perwira",
                                "Penggunaan Senjata Api dan Menembak", "Teknik Keselamatan dan Bela Diri Polri",
                                "Sistem Pelayanan Polri Berbasis Elektronik",
                                "Psikologi Sosial dan Teknik Dasar Konseling",
                                "Manajemen Kehumasan Polri", "Teknologi Informasi Kepolisian",
                                "Pencegahan Kejahatan (Crime Prevention)", "Gladi Wirottama",
                                "Porismas", "Latihan Teknis/Latihan Kerja", "Ujian Kompetensi Perwira Pertama"
                            ];
                        @endphp
                        @foreach($mapels as $i => $mapel)
                            <option value="{{ $mapel }}" {{ old('mapel', $modul->mapel) == $mapel ? 'selected' : '' }}>
                                {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}. {{ $mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tahun</label>
                    <input type="text" name="tahun" value="{{ old('tahun', $modul->tahun) }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required pattern="^[0-9]{4}$" placeholder="Masukkan Tahun (contoh: 2025)">
                </div>

                {{-- File Sebelumnya --}}
                @if ($modul->file)
                    <div class="mb-4">
                        <p class="text-sm text-white font-semibold flex items-center space-x-2">
                            <span>File Modul Saat Ini:</span>
                            <a href="{{ asset('storage/' . $modul->file) }}" target="_blank"
                                class="text-blue-300 underline hover:text-blue-400 transition">
                                Lihat File
                            </a>
                        </p>

                        {{-- Checkbox hapus file --}}
                        <div class="mt-2 flex items-center bg-red-600/20 px-3 py-2 rounded-lg">
                            <input type="checkbox" name="hapus_file" id="hapus_file" value="1"
                                class="mr-2 rounded border-gray-500 focus:ring-red-500">
                            <label for="hapus_file" class="text-red-500 font-semibold hover:text-red-400 transition">
                                Hapus file ini
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Upload File Baru --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Ganti File (PDF)</label>
                    <input type="file" name="file" accept=".pdf"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                    <small class="font-bold text-yellow-400 italic">Kosongkan upload file jika tidak ingin mengganti | Max Size 15 MB</small>
                </div>

                {{-- Tombol --}}
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
