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

                {{-- Periode --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Periode</label>
                    <select id="periode" name="periode"
                        class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Periode --</option>
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

                        prodiklatSelect.addEventListener("change", function () {
                            periodeSelect.innerHTML = '<option value="">-- Pilih Periode --</option>';
                            const selected = this.value;
                            if (options[selected]) {
                                options[selected].forEach(function (p) {
                                    const opt = document.createElement("option");
                                    opt.value = p;
                                    opt.textContent = p;
                                    periodeSelect.appendChild(opt);
                                });
                            }
                        });
                    });
                </script>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                        <option value="Pancasila dan Wawasan Kebangsaan">Pancasila dan Wawasan Kebangsaan</option>
                        <option value="Etika Profesi dan Kepemimpinan">Etika Profesi dan Kepemimpinan</option>
                        <option value="Psikologi Kepolisian">Psikologi Kepolisian</option>
                        <option value="Komunikasi dan Hubungan Masyarakat">Komunikasi dan Hubungan Masyarakat</option>
                        <option value="Teknologi Informasi Kepolisian">Teknologi Informasi Kepolisian</option>
                        <option value="Cybercrime dan Digital Forensik">Cybercrime dan Digital Forensik</option>
                        <option value="Kesehatan Jasmani dan Bela Diri Polri">Kesehatan Jasmani dan Bela Diri Polri</option>
                        <option value="Sistem Informasi Kriminal Nasional">Sistem Informasi Kriminal Nasional</option>
                        <option value="Intelijen Kepolisian">Intelijen Kepolisian</option>
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
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
