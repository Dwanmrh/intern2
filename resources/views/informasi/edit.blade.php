<x-app-layout>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $informasi->judul }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                    <input type="text" name="deskripsi" value="{{ $informasi->deskripsi }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $informasi->tanggal }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Foto Lama --}}
                @if ($informasi->foto)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $informasi->foto) }}" class="h-40 rounded shadow">
                    </div>
                @endif

                {{-- Foto Baru --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="w-full">
                </div>

                {{-- Button --}}
                <div class="flex justify-end">
                    <a href="{{ route('informasi.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
