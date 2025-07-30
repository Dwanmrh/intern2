<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA HEADER INFORMASI --}}
            <div class="shadow rounded-lg p-6 mb-10 relative" style="background-color: rgba(255, 255, 255, 0.40); min-height: 64px;">
                {{-- Judul dan Tombol Tambah --}}
                <div class="relative flex items-center justify-center">
                    <h2 class="text-2xl font-bold text-[#2c3e50]">Kegiatan</h2>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-0 top-1">
                                <a href="{{ route('informasi.create') }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                    + Tambah Kegiatan
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Grid Informasi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @forelse ($informasi as $item)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                     class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-sm text-gray-500 flex items-center gap-1 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="mt-[1px]">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </p>
                                <h3 class="text-lg font-bold text-gray-800 mb-[2px]">{{ $item->judul }}</h3>

                                <p class="text-sm text-gray-600 mb-4">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                                </p>

                                {{-- Aksi --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex justify-end gap-4 mt-auto">
                                            <a href="{{ route('informasi.edit', $item->id) }}"
                                               class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('informasi.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus informasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-3 text-center">Belum ada informasi yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>

            {{-- Media Sosial dan Kontak --}}
            <div class="mt-16 mb-16 bg-gray-100 rounded-lg px-6 py-10 text-center">
                <h3 class="text-lg font-semibold mb-6">Media Sosial dan Kontak</h3>

                <div class="flex flex-wrap justify-center gap-6 mb-10 mt-5">
                    <a href="#" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition duration-300 ease-in-out">
                        <i class="bi bi-instagram text-2xl mb-2"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition duration-300 ease-in-out">
                        <i class="bi bi-youtube text-2xl mb-2"></i>
                        <span>YouTube</span>
                    </a>
                    <a href="#" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition duration-300 ease-in-out">
                        <i class="bi bi-tiktok text-2xl mb-2"></i>
                        <span>TikTok</span>
                    </a>
                    <a href="#" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition duration-300 ease-in-out">
                        <i class="bi bi-telephone text-2xl mb-2"></i>
                        <span>Telpon</span>
                    </a>
                </div>
            </div>

            {{-- Peta --}}
            <div class="mt-10 mb-10 w-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.305004477184!2d106.90528948715817!3d-6.911367899999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848356fffffff%3A0xf319c6be506068e7!2sEducational%20Establishment%20Officer!5e0!3m2!1sen!2sid!4v1753245232528!5m2!1sen!2sid"
                        width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md">
                </iframe>
            </div>

        </div>
    </div>
</x-app-layout>
