<x-app-layout>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Jabatan --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Jabatan</label>
                    <input type="text" name="jabatan" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Foto --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Foto</label>
                    <input type="file" name="foto" class="w-full">
                </div>

                {{-- Button --}}
                <div class="flex justify-end">
                    <a href="{{ route('profil.index') }}"
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
