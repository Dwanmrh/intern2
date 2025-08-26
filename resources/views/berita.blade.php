<x-app-layout>

    @section('title', 'BERITA | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA HEADER BERITA --}}
            <div class="relative bg-gray-50
            backdrop-blur-md rounded-xl shadow-lg px-6 py-4 mb-8 overflow-hidden">
                {{-- Judul Header (tengah, selalu center) --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-white inline-flex items-center gap-2
                            bg-gray-700 px-14 py-1.5 rounded-xl shadow-md
                            hover:scale-105 transition-transform duration-300">
                        <i class="bi bi-journal-text text-white text-xl md:text-2xl"></i>
                        BERITA
                    </h2>
                </div>

                {{-- Tombol Tambah Data (posisi kanan atas) --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('berita.create') }}"
                        class="absolute right-6 top-6
                                bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700
                                hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800
                                text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                transition duration-300 ease-in-out inline-flex items-center">
                            <i class="bi bi-plus-circle text-sm mr-1"></i>
                            Tambah Berita
                        </a>
                    @endif
                @endauth

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div id="success-alert" class="mt-4 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            let alertBox = document.getElementById('success-alert');
                            if (alertBox) {
                                alertBox.style.opacity = '0';
                                setTimeout(() => alertBox.remove(), 500);
                            }
                        }, 5000);
                    </script>
                @endif

                {{-- Grid Kartu Berita --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @forelse ($beritas as $berita)
                        <div onclick="window.location.href='{{ route('berita.show', $berita->id) }}'"
                            class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col cursor-pointer hover:scale-105 transition duration-300 ease-in-out relative">

                            @if ($berita->foto)
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
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
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </p>

                                <h3 class="text-lg font-bold text-gray-800 mb-[2px]">
                                    {{ $berita->judul }}
                                </h3>

                                <p class="text-sm text-gray-600 mb-4">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 100) }}
                                </p>

                                {{-- Aksi Edit & Hapus --}}
                                @auth
                                    @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                        <div class="flex justify-end gap-4 mt-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('berita.edit', $berita->id) }}" onclick="event.stopPropagation()"
                                                class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <button type="button" onclick="event.stopPropagation()"
                                                    class="text-red-600 hover:text-red-800 transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusBeritaModal{{ $berita->id }}"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-3 text-center">Belum ada berita yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    @foreach ($beritas as $berita)
        <div class="modal fade" id="hapusBeritaModal{{ $berita->id }}" tabindex="-1" aria-labelledby="hapusLabel{{ $berita->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header bg-red-600 text-white rounded-t-lg">
                        <h5 class="modal-title" id="hapusLabel{{ $berita->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus berita <b>{{ $berita->judul }}</b>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </form>
                        <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
