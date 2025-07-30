<x-app-layout>
    <div class="py-10 px-4">
        <div class="max-w-xl mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">
            
            {{-- Header --}}
            <h2 class="text-2xl text-white font-bold text-center mb-8">Edit Preview</h2>

            <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $dashboard->judul }}"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul">
                </div>

                {{-- Tanggal --}}
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $dashboard->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required>
                </div>

                {{-- File Lama --}}
                @if ($dashboard->file)
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-2">File Saat Ini</label>
                        <img src="{{ asset('storage/' . $dashboard->file) }}" class="h-40 rounded-lg shadow-md border border-white/20">
                    </div>
                @endif

                {{-- Ganti File --}}
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-1">Ganti File (Opsional)</label>
                    <input type="file" name="file"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition" />
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('dashboard.index') }}"
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
