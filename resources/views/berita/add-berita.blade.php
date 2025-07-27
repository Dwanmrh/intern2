<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Berita
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Judul</label>
                    <input type="text" name="judul" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Isi Berita --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Isi Berita</label>
                    <input type="text" name="isi_berita" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Foto --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Foto</label>
                    <input type="file" name="foto" class="w-full">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end">
                    <a href="{{ route('berita.add-berita') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
