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

                {{-- Periode --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Periode</label>
                    <select id="periode" name="periode"
                            class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Periode --</option>
                        {{-- nanti diisi otomatis via script --}}
                    </select>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const prodiklatSelect = document.getElementById("prodiklat");
                        const periodeSelect = document.getElementById("periode");

                        const options = {
                            SIP: ["SIP", "SIP Gelombang I", "SIP Gelombang II"],
                            PAG: ["PAG", "PAG Gelombang I", "PAG Gelombang II"],
                        };

                        function loadPeriode(selectedProdiklat, currentValue = null) {
                            periodeSelect.innerHTML = '<option value="">-- Pilih Periode --</option>';
                            if (options[selectedProdiklat]) {
                                options[selectedProdiklat].forEach(function (p) {
                                    const opt = document.createElement("option");
                                    opt.value = p;
                                    opt.textContent = p;
                                    if (p === currentValue) {
                                        opt.selected = true;
                                    }
                                    periodeSelect.appendChild(opt);
                                });
                            }
                        }

                        // Load default saat halaman terbuka
                        const currentProdiklat = prodiklatSelect.value;
                        const currentPeriode = "{{ old('periode', $modul->periode) }}";
                        if (currentProdiklat) {
                            loadPeriode(currentProdiklat, currentPeriode);
                        }

                        // Update jika prodiklat diganti
                        prodiklatSelect.addEventListener("change", function () {
                            loadPeriode(this.value);
                        });
                    });
                </script>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                        <option value="Pancasila dan Wawasan Kebangsaan" {{ old('mapel', $modul->mapel) == 'Pancasila dan Wawasan Kebangsaan' ? 'selected' : '' }}>Pancasila dan Wawasan Kebangsaan</option>
                        <option value="Etika Profesi dan Kepemimpinan" {{ old('mapel', $modul->mapel) == 'Etika Profesi dan Kepemimpinan' ? 'selected' : '' }}>Etika Profesi dan Kepemimpinan</option>
                        <option value="Psikologi Kepolisian" {{ old('mapel', $modul->mapel) == 'Psikologi Kepolisian' ? 'selected' : '' }}>Psikologi Kepolisian</option>
                        <option value="Komunikasi dan Hubungan Masyarakat" {{ old('mapel', $modul->mapel) == 'Komunikasi dan Hubungan Masyarakat' ? 'selected' : '' }}>Komunikasi dan Hubungan Masyarakat</option>
                        <option value="Teknologi Informasi Kepolisian" {{ old('mapel', $modul->mapel) == 'Teknologi Informasi Kepolisian' ? 'selected' : '' }}>Teknologi Informasi Kepolisian</option>
                        <option value="Cybercrime dan Digital Forensik" {{ old('mapel', $modul->mapel) == 'Cybercrime dan Digital Forensik' ? 'selected' : '' }}>Cybercrime dan Digital Forensik</option>
                        <option value="Kesehatan Jasmani dan Bela Diri Polri" {{ old('mapel', $modul->mapel) == 'Kesehatan Jasmani dan Bela Diri Polri' ? 'selected' : '' }}>Kesehatan Jasmani dan Bela Diri Polri</option>
                        <option value="Sistem Informasi Kriminal Nasional" {{ old('mapel', $modul->mapel) == 'Sistem Informasi Kriminal Nasional' ? 'selected' : '' }}>Sistem Informasi Kriminal Nasional</option>
                        <option value="Intelijen Kepolisian" {{ old('mapel', $modul->mapel) == 'Intelijen Kepolisian' ? 'selected' : '' }}>Intelijen Kepolisian</option>
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
