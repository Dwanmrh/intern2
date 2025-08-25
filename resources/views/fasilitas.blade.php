<x-app-layout>
    @section('title', 'FASDIK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-[#edf0f8] rounded-xl shadow-lg p-8 mb-10 overflow-hidden">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        {{-- Judul --}}
                        <div class="flex items-center space-x-3">
                            <i class="bi bi-gear-fill text-3xl text-blue-700"></i>
                            <h2 class="text-3xl font-extrabold text-[#2c3e50] tracking-wide">
                                FASILITAS PENDIDIKAN
                            </h2>
                        </div>

                        {{-- Tombol Tambah Data --}}
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('fasilitas.create') }}"
                                    class="bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700 hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800 text-white px-4 py-2 rounded-md text-sm shadow-md transition duration-300 ease-in-out">
                                    <i class="bi bi-plus-circle text-base"></i>
                                    Tambah Fasdik
                                </a>
                            @endif
                        @endauth
                    </div>

                    {{-- Deskripsi --}}
                    <p class="text-gray-700 text-base max-w-xl mt-2">
                        Informasi mengenai berbagai fasilitas pendidikan yang tersedia di lingkungan SETUKPA LEMDIKLAT POLRI untuk menunjang kegiatan pembelajaran dan pelatihan.
                    </p>
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div id="success-alert"
                        class="mt-4 mb-6 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            let alertBox = document.getElementById('success-alert');
                            if (alertBox) {
                                alertBox.style.opacity = '0'; // efek fade out
                                setTimeout(() => alertBox.remove(), 500); // hapus setelah fade
                            }
                        }, 5000); // 5000ms = 5 detik
                    </script>
                @endif

                {{-- LIST CARD --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($fasilitas as $item)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                    <i class="bi bi-image text-3xl"></i>
                                </div>
                            @endif

                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="font-bold text-lg text-gray-800">{{ $item->judul }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $item->deskripsi }}</p>
                                <p class="text-xs text-gray-500 mb-4">
                                    Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                </p>

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

                                            <!-- Tombol Trigger Modal -->
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
                    @empty
                        <p class="text-gray-600">Belum ada fasilitas yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
