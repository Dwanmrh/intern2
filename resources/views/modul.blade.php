<x-app-layout>
    @section('title', 'MODUL | SETUKPA LEMDIKLAT POLRI')

    <div class="pt-4 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gradient-to-r from-[#1E293B] to-[#334155] rounded-xl shadow-lg p-8 mb-10 overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <i class="bi bi-mortarboard-fill text-3xl text-yellow-400"></i>
                            <h2 class="text-3xl font-extrabold text-white tracking-wide">MODUL SISWA</h2>
                        </div>
                        <p class="text-gray-300 text-base leading-relaxed text-justify">
                            Informasi mengenai berbagai modul yang tersedia di lingkungan
                            Setukpa Lemdiklat Polri <br>untuk brmenunjang kegiatan pembelajaran
                            dan pengasuhan siswa.
                        </p>
                    </div>
                </div>
            </div>

            {{-- GRID CARD --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Modul SIP --}}
                <a href="{{ route('modul.sip') }}"
                class="group bg-[#1E293B] hover:bg-[#293545] border border-yellow-500 rounded-xl p-6 shadow-md hover:shadow-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center mb-2 space-x-3">
                        <i class="bi bi-book text-2xl text-yellow-400 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-xl font-bold text-white">MODUL SIP</h3>
                    </div>
                    <p class="text-gray-300 text-base leading-relaxed">
                        Modul SIP berisi berbagai materi pembelajaran, pedoman akademik, serta dokumen penunjang kegiatan belajar mengajar di Setukpa Lemdiklat Polri.
                    </p>
                </a>

                {{-- Modul PAG --}}
                <a href="{{ route('modul.pag') }}"
                class="group bg-[#1E293B] hover:bg-[#293545] border border-yellow-500 rounded-xl p-6 shadow-md hover:shadow-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center mb-2 space-x-3">
                        <i class="bi bi-person-workspace text-2xl text-yellow-400 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-xl font-bold text-white">MODUL PAG</h3>
                    </div>
                    <p class="text-gray-300 text-base leading-relaxed">
                        Modul PAG mencakup pengasuhan, pembinaan kepribadian, serta aktivitas keseharian siswa dalam lingkungan pendidikan kepolisian.
                    </p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>