<x-app-layout>

    @section('title', 'TAMBAH LINK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Link</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('link.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="nama"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan nama website">
                </div>

                {{-- URL --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">URL</label>
                    <input type="url" name="url"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="https://example.com">
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Kategori</label>
                    <select name="kategori" id="kategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="umum">UMUM</option>
                        <option value="sadiklat">SATDIKLAT</option>
                    </select>
                </div>

                {{-- Subkategori (jika SADIKLAT) --}}
                <div class="mb-3" id="subkategori-wrapper" style="display: none;">
                    <label class="block text-white font-semibold mb-1">Subkategori (Pusdik)</label>
                    <select name="subkategori" id="subkategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="">-- Pilih Subkategori --</option>
                        <option value="Sespim">SESPIM</option>
                        <option value="Sespimti">SESPIMTI</option>
                        <option value="Sespimmen">SESPIMMEN</option>
                        <option value="Sespimma">SESPIMMA</option>
                        <option value="STIK-PTIK">STIK-PTIK</option>
                        <option value="Akpol">AKPOL</option>
                        <option value="Diklat Reserse">Diklat RESERSE</option>
                        <option value="Pusdik Lantas">Pusdik LANTAS</option>
                        <option value="Pusdik Sabhara">Pusdik SABHARA</option>
                        <option value="Pusdik Sebasa">Pusdik SEBASA</option>
                        <option value="Pusdik Binmas">Pusdik BINMAS</option>
                        <option value="Pusdik Intel">Pusdik INTEL</option>
                        <option value="Pusdik Min">Pusdik MIN</option>
                        <option value="Pusdik Min">Pusdik BRIMOB</option>
                    </select>
                </div>

                {{-- Logo --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('link.index') }}"
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

    {{-- Script tampilkan subkategori saat pilih sadiklat --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kategoriSelect = document.getElementById('kategori');
            const subkategoriWrapper = document.getElementById('subkategori-wrapper');

            kategoriSelect.addEventListener('change', function () {
                if (this.value === 'sadiklat') {
                    subkategoriWrapper.style.display = 'block';
                } else {
                    subkategoriWrapper.style.display = 'none';
                    document.getElementById('subkategori').value = '';
                }
            });
        });
    </script>

</x-app-layout>
