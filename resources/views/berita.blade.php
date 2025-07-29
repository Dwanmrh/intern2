<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Button Tambah --}}
@auth
    @if(Auth::user()->role === 'admin')
        <div class="mb-3 text-end position-relative z-10">
            <a href="{{ route('berita.create') }}" class="btn btn-primary">
                + Tambah Berita
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

            {{-- Kartu Berita --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($beritas as $berita)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $berita->judul }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</p>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 100) }}
                            </p>
                            {{-- Edit --}}
                            <div class="flex justify-between">
                                <a href="{{ route('berita.edit', $berita->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                {{-- Hapus --}}
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada berita yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
