<x-app-layout>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $dashboard->judul }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $dashboard->tanggal }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- File Lama --}}
                @if ($dashboard->file)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">File Saat Ini</label>
                        <img src="{{ asset('storage/' . $dashboard->file) }}" class="h-40 rounded shadow">
                    </div>
                @endif

                {{-- File Baru --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Ganti File (Opsional)</label>
                    <input type="file" name="file" class="w-full">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end">
                    <a href="{{ route('dashboard.index') }}"
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
