<x-app-layout>

    @section('title', 'Edit Informasi | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Edit Kegiatan</h2>

            <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $informasi->judul }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi" value="{{ $informasi->deskripsi }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $informasi->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                {{-- Foto Lama --}}
                @if ($informasi->foto)
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $informasi->foto) }}"
                             class="h-40 rounded shadow-lg border border-white/20">
                    </div>
                @endif

                {{-- Ganti Foto --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                {{-- Button --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('informasi.index') }}"
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
