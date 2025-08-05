<x-app-layout>
    @section('title', 'Fasilitas | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="shadow rounded-lg p-6 mb-10 bg-white/40 min-h-[64px]">
                <div class="relative flex items-center justify-center">
                    <h2 class="text-2xl font-bold text-[#2c3e50]">Fasilitas</h2>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-0 top-1">
                                <a href="{{ route('fasilitas.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                    + Tambah Fasilitas
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- GRID CARD 3 PILIHAN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Fasilitas Umum --}}
                <a href="{{ route('fasilitas.umum') }}"
                   class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg hover:scale-105 transition transform duration-300 cursor-pointer flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-[#2c3e50] mb-2">Fasilitas Umum</h3>
                    <p class="text-gray-600 text-sm">Berisi informasi berbagai fasilitas umum yang tersedia di SETUKPA seperti lapangan, tempat ibadah, kantin, dan lainnya.</p>
                </a>

                {{-- Fasilitas Belajar --}}
                <a href="{{ route('fasilitas.belajar') }}"
                   class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg hover:scale-105 transition transform duration-300 cursor-pointer flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-[#2c3e50] mb-2">Fasilitas Belajar</h3>
                    <p class="text-gray-600 text-sm">Menyediakan informasi tentang sarana dan prasarana penunjang kegiatan belajar seperti ruang kelas, perpustakaan, dan laboratorium.</p>
                </a>

                {{-- Fasilitas Khusus --}}
                <a href="{{ route('fasilitas.khusus') }}"
                   class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg hover:scale-105 transition transform duration-300 cursor-pointer flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-[#2c3e50] mb-2">Fasilitas Khusus</h3>
                    <p class="text-gray-600 text-sm">Menampilkan fasilitas yang bersifat khusus atau akses terbatas seperti ruang komando, pusat data, dan lain sebagainya.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
