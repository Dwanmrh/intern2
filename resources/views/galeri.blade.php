<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol Tambah --}}
            <div class="mb-4 text-end">
                <a href="{{ route('galeri.create-galeri') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    + Tambah Galeri
                </a>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid Galeri --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($galeris as $galeri)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($galeri->foto)
                            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $galeri->judul }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</p>
                            {{-- Tombol --}}
                            <div class="flex justify-between">
                                <a href="{{ route('galeri.edit-galeri', $galeri->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus galeri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada galeri yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
