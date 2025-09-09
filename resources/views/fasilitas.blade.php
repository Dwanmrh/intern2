<x-app-layout>
    @section('title', 'FASDIK | SETUKPA LEMDIKLAT POLRI')

    <div class="pt-4 pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gray-50
            backdrop-blur-md rounded-xl shadow-lg px-6 py-4 mb-8 overflow-hidden">

                {{-- Judul Header (tengah, selalu center) --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                            bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                            px-4 py-1 rounded-xl shadow-md">
                        <i class="bi bi-bank2 text-white text-xl md:text-lg"></i>
                        EDUCATIONAL FACILITIES
                    </h2>
                </div>

                {{-- Tombol Tambah Data (posisi kanan atas) --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('fasilitas.create') }}"
                        class="absolute right-6 top-6
                        bg-[#800000] hover:bg-[#660000]
                                text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                transition duration-300 ease-in-out inline-flex items-center">
                            <i class="bi bi-plus-circle text-sm mr-1"></i>
                            Tambah Fasdik
                        </a>
                    @endif
                @endauth

                {{-- LIST FASILITAS --}}
                <div class="space-y-12 mt-8">
                    @forelse($fasilitas as $item)
                        <div class="flex flex-col md:flex-row items-start md:items-start gap-6 border-b pb-8">

                            {{-- Gambar --}}
                            <div class="w-full md:w-1/3">
                                <div class="aspect-[16/9] overflow-hidden rounded-lg shadow-md">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover cursor-pointer"
                                            data-bs-toggle="modal"
                                            data-bs-target="#previewImageModal{{ $item->id }}">
                                    @else
                                        <x-placeholder-foto />
                                    @endif
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="w-full md:w-2/3 mt-1 max-w 2xl">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2 inline-block relative pb-1
                                           after:content-[''] after:block after:h-[3px] after:bg-[#2c3e50] after:mt-1 after:w-full">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-gray-600 text-base leading-relaxed mb-3 text-justify">{{ $item->deskripsi }}</p>
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

    {{-- Modal Hapus Fasilitas --}}
    @foreach ($fasilitas as $item)
        <div class="modal fade" id="hapusFasilitasModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="hapusLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered custom-modal">
                <div class="modal-content rounded-2xl shadow-lg border-0">

                    {{-- Header --}}
                    <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                        <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusLabel{{ $item->id }}">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                            Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body text-center py-3 px-3">
                        <i class="bi bi-trash3-fill text-danger fs-3 mb-2"></i>
                        <p class="fw-semibold text-gray-700 mt-4 mb-2" style="font-size: 0.9rem;">
                            Apakah anda yakin ingin menghapus fasilitas <br>
                            <span class="text-danger">"{{ $item->judul }}"</span>?
                        </p>
                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3 py-1 rounded-pill shadow-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button"
                                class="btn btn-primary btn-sm px-3 py-1 rounded-pill shadow-sm"
                                data-bs-dismiss="modal">
                            Batal
                        </button>
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

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="modal fade" id="notifModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content text-center p-4" style="border-radius: 10px; background-color: #ffffff; color: #065f46;">
                                {{-- Icon Centang --}}
                                <div class="mb-2">
                                    <div class="bg-green-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                {{-- Pesan --}}
                                <p class="mb-2 text-sm font-medium">{{ session('success') }}</p>
                                {{-- Tombol --}}
                                <button type="button" class="btn btn-success btn-sm px-3 py-1" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            new bootstrap.Modal(document.getElementById('notifModal')).show();
                        });
                    </script>
                @endif
