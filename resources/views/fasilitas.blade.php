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
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="h-40 w-full object-cover" />
                        @else
                            <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-600">Tidak ada gambar</div>
                        @endif

                        <div class="p-3 flex-grow flex flex-col justify-between">
                            <div>
                                <h5 class="font-semibold text-sm mb-1 truncate">{{ $item->nama }}</h5>
                                <p class="text-xs text-gray-600 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                                <p class="text-[11px] text-gray-400 mt-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex justify-between mt-2 text-sm">
                                <a href="{{ route('fasilitas.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada fasilitas yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
