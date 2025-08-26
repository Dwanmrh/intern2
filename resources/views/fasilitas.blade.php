<x-app-layout>
    @section('title', 'FASDIK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gray-50
            backdrop-blur-md rounded-xl shadow-lg px-6 py-4 mb-8 overflow-hidden">

                {{-- Judul Header (tengah, selalu center) --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-white inline-flex items-center gap-2 
                            bg-gray-700 px-4 py-2 rounded-xl shadow-md 
                            hover:scale-105 transition-transform duration-300">
                        <i class="bi bi-bank2 text-white text-xl md:text-2xl"></i>
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
                                text-white px-4 py-2 rounded-md text-sm shadow-md 
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
                                         class="rounded-lg shadow-md w-full object-cover h-56">
                                @else
                                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                        <i class="bi bi-image text-3xl"></i>
                                    </div>
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
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex gap-4">
                                            <a href="{{ route('fasilitas.edit', $item->id) }}"
                                               class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <i class="bi bi-pencil-square text-lg"></i>
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
