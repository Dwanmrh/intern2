<footer class="bg-gray-800 text-white mt-16">
    <div class="max-w-7xl mx-auto py-10 px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Logo --}}
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('assets/images/LOGO_SECAPA.png') }}" alt="Logo" class="w-20 h-auto mb-4">
        </div>

        {{-- Navigasi --}}
        <div class="flex flex-col items-center">
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-blue-300">Home</a></li>
                <li><a href="profil" class="hover:text-blue-300">Profil</a></li>
                <li><a href="{{ route('informasi.index') }}" class="hover:text-blue-300">Informasi</a></li>
                <li><a href="{{ route('berita') }}" class="hover:text-blue-300">Berita</a></li>
                <li><a href="{{ route('galeri.index') }}" class="hover:text-blue-300">Galeri</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div class="text-sm text-center md:text-right">
            <p>Jl. Bhayangkara No.116, Karamat, Kec. Gunungpuyuh,<br>Kota Sukabumi, Jawa Barat 43122</p>
            <p class="mt-2">Telp: -</p>
            <p>Email: <a href="mailto:setukpaweb@gmail.com" class="hover:text-blue-300">setukpaweb@gmail.com</a></p>
        </div>
    </div>

    <div class="border-t border-gray-700 py-4 px-6 text-sm flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto">
        <p class="text-center md:text-left mb-2 md:mb-0">&copy; 2025 Setukpa Lemdiklat Polri Sukabumi</p>
        <div class="flex gap-4">
            <a href="#" class="hover:text-blue-300"><i class="bi bi-youtube"></i></a>
            <a href="#" class="hover:text-blue-300"><i class="bi bi-instagram"></i></a>
            <a href="#" class="hover:text-blue-300"><i class="bi bi-tiktok"></i></a>
        </div>
    </div>
</footer>
