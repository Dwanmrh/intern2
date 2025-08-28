<x-app-layout>

    @section('title', $berita->judul . ' | SETUKPA LEMDIKLAT POLRI')

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                {{-- HERO IMAGE + Judul --}}
            @if ($berita->foto)
            <div class="relative w-full aspect-[2/1] rounded-xl overflow-hidden shadow-lg mb-8">
                    <img src="{{ asset('storage/' . $berita->foto) }}"
                         alt="{{ $berita->judul }}"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    {{-- Judul di atas gambar --}}
                    <div class="absolute bottom-6 left-6 right-6">
                        <h1 class="text-2xl md:text-4xl font-bold text-white drop-shadow-lg">
                            {{ $berita->judul }}
                        </h1>
                    </div>
                </div>
            @endif
                {{-- Info Berita --}}
                <div class="flex flex-wrap items-center text-lg text-gray-500 gap-4 mb-6">
                    {{-- Tanggal --}}
                    <div class="flex items-center gap-1">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </div>
                    {{-- Penulis (opsional) --}}
                    <div class="flex items-center gap-1">
                        <i class="bi bi-person-circle"></i>
                        Admin SETUKPA
                    </div>
                </div>

                {{-- Isi Berita --}}
                <div class="text-gray-800 leading-relaxed text text-xl max-w-none">
                    {!! $berita->isi_berita !!}
                </div>

                {{-- Share Section --}}
                <div class="mt-8 border-t border-gray-300 text-gray-500 pt-6 flex items-center justify-between flex-wrap gap-3">
                    <span class="text-lg text-gray-500">Bagikan berita ini:</span>
                    <div class="flex gap-3 text-lg">
                        {{-- FACEBOOK tetap --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" class="text-blue-600 hover:text-blue-800 transition">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
                           target="_blank" class="text-sky-500 hover:text-sky-700 transition">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
                           target="_blank" class="text-green-500 hover:text-green-700 transition">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        {{-- Tombol Copy Link --}}
                        <button onclick="copyLink()"
                                class="text-gray-600 hover:text-gray-900 transition">
                            <i class="bi bi-link-45deg"></i>
                        </button>
                    </div>
                </div>

                {{-- Toast Notification (Atas Tengah) --}}
                <div id="copyToast"
                     class="hidden fixed top-6 left-1/2 transform -translate-x-1/2 bg-white text-gray px-6 py-3 rounded-lg shadow-lg text-sm font-medium opacity-0 transition-opacity duration-500 z-50">
                    ✅ Link berita berhasil disalin
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-8">
                    @php
                        $previous = url()->previous();
                        $beritaIndex = route('berita.index');
                        $home = route('dashboard.index'); // sesuaikan route dashboard
                    @endphp

                    <a href="{{ str_contains($previous, 'berita') ? $beritaIndex : $home }}"
                    class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-700 to-gray-800 
                        hover:from-gray-800 hover:to-black text-white text-sm font-medium rounded-lg shadow transition">
                        <i class="bi-chevron-left"></i> Kembali
                    </a>
                </div>
            </div>
    </div>

    {{-- Script untuk Copy Toast --}}
    <script>
        function copyLink() {
            navigator.clipboard.writeText("{{ request()->fullUrl() }}");
            let toast = document.getElementById('copyToast');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('opacity-100');
            }, 10);

            // Hilang otomatis setelah 3 detik
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 3000);
        }
    </script>

</x-app-layout>
