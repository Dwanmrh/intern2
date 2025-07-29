<footer class="bg-gray-800 text-white text-sm mt-10 border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-6 px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Logo --}}
        <div class="flex flex-col items-center md:items-start gap-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-14 h-auto">
        </div>

        {{-- Navigasi --}}
        <div class="flex flex-col items-center gap-1">
            <a href="{{ url('/') }}" class="hover:text-blue-300">Home</a>
            <a href="{{ url('profil') }}" class="hover:text-blue-300">Profil</a>
            <a href="{{ route('informasi.index') }}" class="hover:text-blue-300">Informasi</a>
            <a href="{{ route('berita.index') }}" class="hover:text-blue-300">Berita</a>
            <a href="{{ route('galeri.index') }}" class="hover:text-blue-300">Galeri</a>
        </div>

        {{-- Kontak --}}
        <div class="text-center md:text-right space-y-1">
            <p>Jl. Bhayangkara No.116, Karamat,<br>Kota Sukabumi, Jawa Barat 43122</p>
            <p>Telp: -</p>
            <p>Email: <a href="mailto:setukpaweb@gmail.com" class="hover:text-blue-300">setukpaweb@gmail.com</a></p>
        </div>
    </div>

    <div class="border-t border-gray-700 py-3 px-4 flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto gap-2 text-xs">
        <p>&copy; 2025 Setukpa Lemdiklat Polri Sukabumi</p>
        <div class="flex gap-3 text-base">
            <a href="#" class="hover:text-blue-300"><i class="bi bi-youtube"></i></a>
            <a href="#" class="hover:text-blue-300"><i class="bi bi-instagram"></i></a>
            <a href="#" class="hover:text-blue-300"><i class="bi bi-tiktok"></i></a>
        </div>
    </div>
</footer>
