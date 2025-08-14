<x-app-layout>

    @section('title', 'EDIT PREVIEW | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-semibold text-center mb-4">Edit Preview</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-4 py-2 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $dashboard->judul }}"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul preview">
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" value="{{ $dashboard->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                </div>

                {{-- File Lama --}}
                @if ($dashboard->file)
                    <div class="mb-4">
                        <label class="block text-white text-sm font-medium mb-1">File Saat Ini</label>
                        <img src="{{ asset('storage/' . $dashboard->file) }}" class="h-40 rounded-md shadow-md border border-white/20">
                    </div>
                @endif

                {{-- Ganti File --}}
                <div class="mb-4">
                    <label class="block text-white text-sm font-medium mb-1">Ganti File Preview (Opsional)</label>
                    <input type="file" name="file"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition" />
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('dashboard.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Perbarui
                    </button>
                </div>
            </form>

            {{-- Flatpickr --}}
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
            <script>
                flatpickr("#tanggal", {
                    dateFormat: "d/m/Y",
                    locale: "id",
                });
            </script>
        </div>
    </div>
</x-app-layout>
