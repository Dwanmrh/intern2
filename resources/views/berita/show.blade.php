<x-app-layout>

    @section('title', $berita->judul . ' | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">

                {{-- Gambar Berita --}}
                @if ($berita->foto)
                <div class="w-full bg-gray-100 rounded mb-6 overflow-hidden flex justify-center items-center border border-gray-200 shadow-sm">
                    <img src="{{ asset('storage/' . $berita->foto) }}"
                        alt="{{ $berita->judul }}"
                        class="max-h-[450px] w-auto object-contain">
                </div>
                @endif

                {{-- Tanggal --}}
                <p class="text-sm text-gray-500 flex items-center gap-1 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                </p>

                {{-- Judul --}}
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $berita->judul }}</h1>

                {{-- Isi Berita --}}
                <div class="text-gray-700 leading-relaxed prose max-w-none">
                    {!! $berita->isi_berita !!}
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-6">
                    <a href="{{ route('berita.index') }}"
                       class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        ← Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
