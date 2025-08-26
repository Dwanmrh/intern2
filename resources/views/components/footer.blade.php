<footer class="bg-gray-800 text-white text-sm mt-10 border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-6 px-6">

        <!-- Grid utama: Logo | Navigasi | Kontak -->
        <div class="grid grid-cols-1 md:grid-cols-[200px,1fr,1fr] gap-12">
            
            {{-- Logo --}}
            <div class="flex items-start">
                <img src="{{ asset('assets/images/logo_setukpa.png') }}" alt="Logo" class="w-28 h-auto">
            </div>

            {{-- Navigasi --}}
            <div class="px-4">
                <div class="grid grid-cols-3 gap-y-4 text-sm">
                    <div class="text-left"><a href="{{ url('/') }}" class="hover:text-blue-300">HOME</a></div>
                    <div class="text-center"><a href="{{ url('profil') }}" class="hover:text-blue-300">PROFIL</a></div>
                    <div class="text-right"><a href="{{ route('berita.index') }}" class="hover:text-blue-300">BERITA</a></div>

                    <div class="text-left"><a href="{{ route('informasi.index') }}" class="hover:text-blue-300">INFORMASI</a></div>
                    <div class="text-center"><a href="{{ route('fasilitas.index') }}" class="hover:text-blue-300">FASDIK</a></div>
                    <div class="text-right"><a href="{{ route('link.index') }}" class="hover:text-blue-300">LINK</a></div>

                    <div class="text-left"><a href="{{ route('modul.index') }}" class="hover:text-blue-300">MODUL</a></div>
                </div>
            </div>

            {{-- Kontak (tengah kolom) --}}
            <div class="space-y-1 mx-auto">
                <p class="flex items-start">
                    <i class="bi bi-geo-alt-fill mr-2 text-blue-400 mt-1"></i>
                    Jl. Bhayangkara No.116, Karamat,<br>
                    Kota Sukabumi, Jawa Barat 43122
                </p>
                <p class="flex items-center">
                    <i class="bi bi-telephone-fill mr-2 text-blue-400"></i>
                    Telp: (0622) 66225481
                </p>
                <p class="flex items-center">
                    <i class="bi bi-envelope-fill mr-2 text-blue-400"></i>
                    Email: 
                    <a href="mailto:setukpaweb@gmail.com" class="hover:text-blue-300">
                        setukpaweb@gmail.com
                    </a>
                </p>
            </div>
        </div>

        <!-- Garis + Copyright -->
        <div class="border-t border-gray-700 mt-6 pt-3 flex flex-col md:flex-row justify-between items-center gap-2 text-xs">
            <p>&copy; 2025 Setukpa Lemdiklat Polri Sukabumi by RR</p>
            <div class="flex gap-4 text-base">
                <a href="https://youtube.com/@humassetukpa566?si=b4Ret7QbAoK5vW39" class="hover:text-blue-300">
                    <i class="bi bi-youtube"></i>
                </a>
                <a href="https://www.instagram.com/humas_setukpa?igsh=MTE3dWU4emFjYjFtdg==" class="hover:text-blue-300">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.tiktok.com/@humas_setukpa?_t=ZS-8yOduXJ7cs4&_r=1" class="hover:text-blue-300">
                    <i class="bi bi-tiktok"></i>
                </a>
            </div>
        </div>

    </div>
</footer>
