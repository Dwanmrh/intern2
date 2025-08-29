<x-app-layout>
    @section('title', 'FASDIK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gray-50
            backdrop-blur-md rounded-xl shadow-lg px-6 py-4 mb-8 overflow-hidden">

                {{-- Judul Header (tengah, selalu center) --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-base font-bold text-white inline-flex items-center gap-2
                            bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                            px-4 py-1 rounded-xl shadow-md">
                        <i class="bi bi-bank2 text-white text-xl md:text-lg"></i>
                        FASILITAS PENDIDIKAN
                    </h2>
                </div>

                {{-- Tombol Tambah Data (posisi kanan atas) --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('fasilitas.create') }}"
                        class="absolute right-6 top-6
                                bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700
                                hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800
                                text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                transition duration-300 ease-in-out inline-flex items-center">
                            <i class="bi bi-plus-circle text-sm mr-1"></i>
                            Tambah Fasdik
                        </a>
                    @endif
                @endauth

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div id="success-alert"
                         class="mt-6 mb-6 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500 text-center">
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

                {{-- LIST FASILITAS --}}
                <div class="space-y-12 mt-8">
                    @forelse($fasilitas as $item)
                        <div class="flex flex-col md:flex-row items-start md:items-start gap-6 border-b pb-8">

                            {{-- Gambar --}}
                            <div class="w-full md:w-1/3">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->judul }}"
                                        class="rounded-lg shadow-md w-full object-cover h-56 cursor-pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#previewImageModal{{ $item->id }}">
                                @else
                                    <x-placeholder-foto height="h-56" />
                                @endif
                            </div>

                            {{-- Konten --}}
                            <div class="w-full md:w-2/3 mt-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2 inline-block relative pb-1
                                           after:content-[''] after:block after:h-[3px] after:bg-[#2c3e50] after:mt-1 after:w-full">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-gray-600 text-base leading-relaxed mb-3">{{ $item->deskripsi }}</p>
                                <p class="text-sm text-gray-500 mb-4">
                                    Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                </p>

                                {{-- Aksi Edit & Hapus --}}
                                @auth
                                    @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                        <div class="flex gap-2 mt-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('fasilitas.edit', $item->id) }}" onclick="event.stopPropagation()"
                                            class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition"
                                            title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121
                                                            2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <button type="button" onclick="event.stopPropagation()"
                                                    class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusFasilitasModal{{ $item->id }}"
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
                        <p class="text-gray-600">Belum ada fasilitas yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    @foreach ($fasilitas as $item)
        <div class="modal fade" id="hapusFasilitasModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header bg-red-600 text-white rounded-t-lg">
                        <h5 class="modal-title" id="hapusLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus fasilitas <b>{{ $item->judul }}</b>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </form>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-800" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Preview Gambar --}}
    @foreach ($fasilitas as $item)
        @if($item->foto)
            <div class="modal fade" id="previewImageModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0 shadow-none relative">

                        {{-- Tombol Tutup (ikon X di pojok kanan atas) --}}
                        <button type="button"
                                class="absolute top-3 right-3 text-white bg-black/40 hover:bg-black/80
                                    rounded-full w-10 h-10 flex items-center justify-center
                                    shadow-lg transition z-10"
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>


                        <div class="modal-body text-center p-0">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 alt="{{ $item->judul }}"
                                 class="img-fluid rounded-lg shadow-lg w-full">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

</x-app-layout>
