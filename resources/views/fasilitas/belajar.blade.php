<x-app-layout>

    @section('title', 'Fasilitas Belajar | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA HEADER --}}
            <div class="shadow rounded-lg p-6 mb-10 relative" style="background-color: rgba(255, 255, 255, 0.40); min-height: 64px;">

                {{-- Judul --}}
                <div class="relative flex items-center justify-center">
                    <h2 class="text-2xl font-bold text-[#2c3e50]">Fasilitas Belajar</h2>
                </div>

                {{-- Tombol Kembali --}}
                <div class="absolute left-4 top-6">
                    <a href="{{ route('fasilitas.index') }}"
                    class="inline-flex items-center px-3 py-1.5 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium rounded transition duration-200">
                        ← Kembali
                    </a>
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- SUBKATEGORI & GRID --}}
                @forelse ($fasilitas as $subKategori => $items)

                {{-- HEADER SUBKATEGORI --}}
                    <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <div class="bg-gradient-to-r from-gray-100 to-gray-200 px-4 py-2 rounded-full text-base font-semibold text-[#2c3e50] shadow transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:from-gray-200 hover:to-gray-300">
                            {{ $subKategori }}
                        </div>
                    </div>

                    {{-- GRID PER SUBKATEGORI --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @foreach ($items as $item)
                            <div x-data="{ showDetailBtn: false }"
                                @click="showDetailBtn = !showDetailBtn"
                                class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col cursor-pointer hover:scale-105 transition duration-300 ease-in-out relative">

                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                        class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="p-4 flex flex-col flex-grow pointer-events-auto">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                                    </p>

                                    <div x-show="showDetailBtn" x-transition
                                        class="mt-auto flex justify-end items-center gap-2">
                                        <a href="{{ route('fasilitas.show', $item->id) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition duration-200 ease-in-out">
                                            Lihat Detail
                                        </a>
                                    </div>

                                    {{-- Aksi Edit & Hapus --}}
                                    @auth
                                        @if(Auth::user()->role === 'admin')
                                            <div class="flex justify-end gap-4 mt-4">
                                                <a href="{{ route('fasilitas.edit', $item->id) }}" @click.stop
                                                    class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                    </svg>
                                                </a>

                                                <button type="button" @click.stop
                                                        class="text-red-600 hover:text-red-800 transition"
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
                        @endforeach
                    </div>
                @empty
                    <p class="text-gray-600 text-center mt-6">Belum ada fasilitas belajar yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    @foreach($fasilitas->flatten() as $item)
        <div class="modal fade" id="hapusFasilitasModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusFasilitasLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="hapusFasilitasLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus fasilitas <strong>{{ $item->judul }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
