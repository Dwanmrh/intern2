<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Hero / Header Image --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/images/setukpa2.jpg') }}" class="rounded shadow mx-auto" alt="Profil Setukpa" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>

            {{-- Section Berita --}}
            <div class="bg-white mt-10 shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Berita</h3>
                    <a href="{{ route('berita') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">
                        Lihat Lebih Lanjut <i class="bi bi-journal-text"></i>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @for($i = 0; $i < 4; $i++)
                    <div class="bg-gray-100 rounded shadow hover:shadow-md overflow-hidden">
                        <img src="{{ asset('assets/images/berita4.jpg') }}" alt="Berita" class="w-full h-40 object-cover">
                        <div class="p-4 text-sm">
                            <p class="text-gray-500 text-xs mb-1"><i class="bi bi-calendar"></i> Sabtu, 08 Mei 2025</p>
                            <p class="text-gray-700 mb-2">Teks</p>
                            <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">
                                Baca Lebih Lanjut <i class="bi bi-journal-text"></i>
                            </a>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Section Galeri --}}
            <div class="bg-white mt-10 shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Galeri</h3>
                    <a href="{{ route('galeri') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">
                        Lihat Lebih Lanjut <i class="bi bi-journal-text"></i>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @for($i = 0; $i < 4; $i++)
                    <div class="bg-gray-100 rounded shadow hover:shadow-md overflow-hidden">
                        <img src="{{ asset('assets/images/sipls3.jpg') }}" alt="Galeri" class="w-full h-40 object-cover">
                        <div class="p-4 text-sm">
                            <p class="text-gray-500 text-xs mb-1"><i class="bi bi-calendar"></i> Jumat, 24 April 2025</p>
                            <p class="text-gray-700 mb-2">Teks</p>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
