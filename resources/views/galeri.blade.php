<x-app-layout>
    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Card Galeri --}}
            <div class="bg-gray-200 rounded-lg p-6 shadow-sm">

                {{-- Header --}}
                <div class="relative mb-6">
                    <h2 class="text-2xl font-bold text-center text-[#2c3e50]">Galeri</h2>

                    {{-- Button Tambah --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute top-0 right-0">
                                <a href="{{ route('galeri.create') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                    + Tambah Konten
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Grid Konten --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($galeris as $galeri)
                        <div class="bg-white rounded-lg shadow hover:shadow-md overflow-hidden flex flex-col">
                            @if ($galeri->foto)
                                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}"
                                     class="h-56 w-full object-cover object-center" />
                            @else
                                <div class="h-56 bg-gray-300 flex items-center justify-center text-gray-600">
                                    Tidak ada konten
                                </div>
                            @endif

                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    {{-- Tanggal dengan Icon --}}
                                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}
                                    </p>
                                    <h3 class="font-semibold text-sm mb-1 truncate text-gray-800">{{ $galeri->judul }}</h3>

                                </div>

                                {{-- Aksi --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex justify-end mt-3 gap-4 text-sm">
                                            {{-- Edit --}}
                                            <a href="{{ route('galeri.edit', $galeri->id) }}" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 hover:text-blue-800 transition" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus konten ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800 transition" fill="none"
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
                        <p class="text-gray-600 col-span-3 text-center">Belum ada konten yang ditambahkan.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
