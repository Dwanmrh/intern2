<x-app-layout>

    {{-- Button Tambah --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="mb-3 text-end position-relative z-10">
                <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                    + Tambah Fasilitas
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

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Grid Fasilitas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @forelse ($fasilitas as $item)
                    <div class="bg-white rounded-lg shadow hover:shadow-md overflow-hidden flex flex-col">
                        @if ($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="h-40 w-full object-cover" />
                        @else
                            <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-600">Tidak ada gambar</div>
                        @endif

                        <div class="p-3 flex-grow flex flex-col justify-between">
                            <div>
                                <p class="text-[11px] text-gray-400 mt-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                                <h5 class="font-semibold text-sm mb-1 truncate">{{ $item->judul }}</h5>
                                <p class="text-xs text-gray-600 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                            </div>

                            {{-- Tombol Aksi --}}
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex justify-end gap-4 mt-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('fasilitas.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus fasilitas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada fasilitas yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
