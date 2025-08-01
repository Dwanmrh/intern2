<footer class="bg-gray-800 text-white text-sm mt-10 border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-6 px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Logo --}}
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-28 h-auto mb-3">
        </div>

        {{-- Navigasi dua baris --}}
        <div class="flex flex-col items-center md:items-start space-y-3">
            <div class="flex flex-wrap gap-x-10 gap-y-3">
                <a href="{{ url('/') }}" class="hover:text-blue-300">Home</a>
                <a href="{{ url('profil') }}" class="hover:text-blue-300">Profil</a>
                <a href="{{ route('informasi.index') }}" class="hover:text-blue-300">Informasi</a>
            </div>
            <div class="flex flex-wrap gap-x-10 gap-y-3">
                <a href="{{ route('berita.index') }}" class="hover:text-blue-300">Berita</a>
                <a href="{{ route('fasilitas.index') }}" class="hover:text-blue-300">Fasilitas</a> <!-- Tambahan -->
                <a href="{{ route('galeri.index') }}" class="hover:text-blue-300">Galeri</a>
            </div>
        </div>

        {{-- Kontak --}}
        <div class="text-center md:text-right space-y-1">
            <p>Jl. Bhayangkara No.116, Karamat,<br>Kota Sukabumi, Jawa Barat 43122</p>
            <p>Telp: (0622) 66225481</p>
            <p>Email: <a href="mailto:setukpaweb@gmail.com" class="hover:text-blue-300">setukpaweb@gmail.com</a></p>
        </div>
    </div>

    <div class="border-t border-gray-700 py-3 px-6 flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto gap-2 text-xs">
        <p>&copy; 2025 Setukpa Lemdiklat Polri Sukabumi by RR</p>
        <div class="flex gap-4 text-base">
            <a href="https://youtube.com/@humassetukpa566?si=b4Ret7QbAoK5vW39" class="hover:text-blue-300"><i class="bi bi-youtube"></i></a>
            <a href="https://www.instagram.com/humas_setukpa?igsh=MTE3dWU4emFjYjFtdg==" class="hover:text-blue-300"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/@humas_setukpa?_t=ZS-8yOduXJ7cs4&_r=1" class="hover:text-blue-300"><i class="bi bi-tiktok"></i></a>
        </div>
    </div>
</footer>
