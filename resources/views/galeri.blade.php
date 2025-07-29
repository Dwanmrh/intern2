<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Button Tambah --}}
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="mb-3 text-end position-relative z-10">
                        <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                            + Tambah Konten
                        </a>
                    </div>
                @endif
            @endauth

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid Konten --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($galeris as $galeri)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($galeri->foto)
                            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada konten
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $galeri->judul }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</p>

                            {{-- Button --}}
                            <div class="flex justify-between">
                                <a href="{{ route('galeri.edit', $galeri->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus konten ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada konten yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
