<x-app-layout>
    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $berita->judul }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Isi Berita --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Isi Berita</label>
                    <textarea name="isi_berita" class="w-full border-gray-300 rounded-md shadow-sm" rows="5">{{ $berita->isi_berita }}</textarea>
                </div>

                {{-- File Berita Sebelumnya --}}
                @if ($berita->file_berita)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">File Berita Saat Ini</label>
                        <a href="{{ asset('storage/' . $berita->file_berita) }}" target="_blank"
                           class="text-blue-600 underline">Lihat File</a>
                    </div>
                @endif

                {{-- Ganti File Word/PDF --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Upload File Baru (Opsional)</label>
                    <input type="file" name="file_berita" class="w-full" accept=".pdf,.docx">
                </div>

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $berita->tanggal }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Foto Lama --}}
                @if ($berita->foto)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $berita->foto) }}" class="h-40 rounded shadow">
                    </div>
                @endif

                {{-- Foto Baru --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="w-full">
                </div>

                {{-- Button --}}
                <div class="flex justify-end">
                    <a href="{{ route('berita.index') }}"
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
