<x-app-layout>

    @section('title', 'Edit Link | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Edit Link</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('link.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ $link->nama }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan nama link">
                </div>

                {{-- URL --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">URL</label>
                    <input type="url" name="url" value="{{ $link->url }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Kategori</label>
                    <select name="kategori" id="kategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="umum" {{ $link->kategori == 'umum' ? 'selected' : '' }}>Umum</option>
                        <option value="sadiklat" {{ $link->kategori == 'sadiklat' ? 'selected' : '' }}>SADIKLAT</option>
                    </select>
                </div>

                {{-- Subkategori --}}
                <div class="mb-3" id="subkategori-wrapper" style="{{ $link->kategori == 'sadiklat' ? '' : 'display: none;' }}">
                    <label class="block text-white font-semibold mb-1">Subkategori (Pusdik)</label>
                    <select name="subkategori" id="subkategori"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="">-- Pilih Subkategori --</option>
                        @php
                            $subkategories = [
                                'Pusdik Serse', 'Pusdik Intel', 'Pusdik Lantas', 'Pusdik Binmas', 'Pusdik Runmin',
                                'Pusdik Sabara', 'Pusdik Sebasa', 'Pusdik Akpol', 'Pusdik Sespima', 'Pusdik Sespimen',
                                'Pusdik Sespim', 'Pusdik Sespimti', 'Pusdik PTIK', 'Pusdik LSP'
                            ];
                        @endphp
                        @foreach ($subkategories as $pusdik)
                            <option value="{{ $pusdik }}" {{ $link->subkategori == $pusdik ? 'selected' : '' }}>
                                {{ $pusdik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Logo Lama --}}
                @if ($link->logo)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">Logo Saat Ini</label>
                        <img src="{{ asset('storage/' . $link->logo) }}" class="h-20 mb-2 rounded shadow">
                    </div>
                @endif

                {{-- Upload Logo Baru --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Ganti Logo (Opsional)</label>
                    <input type="file" name="logo" accept="image/*"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    @php
                        $backRoute = request('from') === 'sadiklat' ? route('sadiklat.index') : route('link.index');
                    @endphp

                    <a href="{{ $backRoute }}"
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

{{-- Script tampilkan subkategori saat pilih sadiklat --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategori');
        const subkategoriWrapper = document.getElementById('subkategori-wrapper');
        const subkategoriSelect = document.getElementById('subkategori');

        function toggleSubkategori() {
            if (kategoriSelect.value === 'sadiklat') {
                subkategoriWrapper.style.display = 'block';
            } else {
                subkategoriWrapper.style.display = 'none';
                subkategoriSelect.value = '';
            }
        }

        kategoriSelect.addEventListener('change', toggleSubkategori);
        toggleSubkategori(); // initialize
    });
</script>
