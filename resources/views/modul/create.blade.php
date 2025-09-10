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

                    @if(!empty($prodiklat))
                        {{-- Jika dipanggil dari SIP atau PAG, kunci pilihan --}}
                        <input type="hidden" name="prodiklat" value="{{ $prodiklat }}">
                        <input type="text" value="{{ $prodiklat }}"
                            class="w-full rounded p-2 bg-gray-300 text-gray-700 font-bold" readonly>
                    @else
                        {{-- Jika tidak ada (misal dari index modul), tampilkan dropdown normal --}}
                        <select name="prodiklat" id="prodiklat" class="w-full rounded p-2">
                            <option value="SIP" {{ old('prodiklat') == 'SIP' ? 'selected' : '' }}>SIP</option>
                            <option value="PAG" {{ old('prodiklat') == 'PAG' ? 'selected' : '' }}>PAG</option>
                        </select>
                    @endif
                </div>

                {{-- Mapel --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Mapel</label>
                    <select id="mapel" name="mapel" class="w-full px-3 py-2 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach (config('mapel.' . old('prodiklat', $prodiklat ?? 'SIP')) as $i => $m)
                            <option value="{{ $m }}" {{ old('mapel') == $m ? 'selected' : '' }}>
                                {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}. {{ $m }}
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
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>

                    <a href="{{ url()->previous() ?? route('modul.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>