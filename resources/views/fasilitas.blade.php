<x-app-layout>
    @section('title', 'FASILITAS | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-[#edf0f8] rounded-xl shadow-lg p-8 mb-10 overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <i class="bi bi-gear-fill text-3xl text-blue-700"></i>
                            <h2 class="text-3xl font-extrabold text-[#2c3e50] tracking-wide">FASILITAS</h2>
                        </div>
                        <p class="text-gray-700 text-base max-w-xl">
                            Informasi mengenai berbagai fasilitas yang tersedia di lingkungan SETUKPA LEMDIKLAT POLRI untuk menunjang kegiatan pembelajaran dan pelatihan.
                        </p>
                    </div>

            {{-- Tombol Tambah Data --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="flex justify-center py-4 pr-4">
                            <a href="{{ route('fasilitas.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-1.5 rounded-md text-sm shadow transition duration-300">
                                <i class="bi bi-plus-circle text-base text-white"></i>
                                Tambah Fasilitas
                            </a>
                        </div>
                    @endif
                @endauth
                </div>
            </div>

            {{-- GRID CARD --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Fasilitas Umum --}}
                <a href="{{ route('fasilitas.umum') }}"
                    class="group bg-white border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                    <div class="flex items-center mb-4 space-x-3">
                        <i class="bi bi-building text-2xl text-blue-700 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-xl font-bold text-[#2c3e50]">Fasilitas Umum</h3>
                    </div>
                    <p class="text-gray-700 text-lg leading-relaxed">Informasi fasilitas umum seperti lapangan, tempat ibadah, kantin, dan lainnya.</p>
                </a>

                {{-- Fasilitas Belajar --}}
                <a href="{{ route('fasilitas.belajar') }}"
                    class="group bg-white border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                    <div class="flex items-center mb-4 space-x-3">
                        <i class="bi bi-journal-bookmark text-2xl text-green-600 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-xl font-bold text-[#2c3e50]">Fasilitas Belajar</h3>
                    </div>
                    <p class="text-gray-700 text-lg leading-relaxed">Ruang kelas, Lapangan Tembak, dan Dojo penunjang kegiatan belajar.</p>
                </a>

                {{-- Fasilitas Khusus --}}
                <a href="{{ route('fasilitas.khusus') }}"
                    class="group bg-white border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                    <div class="flex items-center mb-4 space-x-3">
                        <i class="bi bi-shield-lock text-2xl text-red-600 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-xl font-bold text-[#2c3e50]">Fasilitas Khusus</h3>
                    </div>
                    <p class="text-gray-700 text-lg leading-relaxed">Fasilitas terbatas seperti Pom Bensin, Barak, Lapangan Apel, dan sejenisnya.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
