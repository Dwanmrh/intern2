<x-app-layout>

    @section('title', $berita->judul . ' | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- ====== KONTEN BERITA (2/3) ====== --}}
                <div class="lg:col-span-2">

                    {{-- Judul --}}
                    <h1 class="text-4xl font-extrabold text-gray-900 leading-snug mb-5">
                        {{ $berita->judul }}
                    </h1>

                    {{-- Info berita --}}
                    <div class="flex flex-wrap items-center text-sm text-gray-500 gap-5 mb-8 border-b border-gray-200 pb-4">
                        <span class="flex items-center gap-1">
                            <i class="bi bi-calendar-event text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="bi bi-person-circle text-blue-500"></i>
                            Admin Setukpa
                        </span>
                    </div>

                    {{-- Gambar utama --}}
                    @if ($berita->foto)
                        <div class="w-full mb-10">
                            <img src="{{ asset('storage/' . $berita->foto) }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-full max-h-[520px] rounded-xl object-cover shadow-md">
                        </div>
                    @endif

                    {{-- Isi berita --}}
                    <div class="prose max-w-none text-gray-800 text-lg leading-relaxed">
                        {!! $berita->isi_berita !!}
                    </div>

                    {{-- Share Section --}}
                    <div class="mt-12 border-t border-gray-200 pt-6 flex items-center justify-between flex-wrap gap-4 text-gray-600">
                        <span class="font-medium">Bagikan berita ini:</span>
                        <div class="flex gap-4 text-xl">

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" class="hover:opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1877F2" class="w-[1em] h-[1em]">
                                    <path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.03 1.79-4.71 4.52-4.71 1.31 0 2.68.24 2.68.24v2.95h-1.51c-1.49 0-1.95.94-1.95 1.9v2.29h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/>
                                </svg>
                            </a>

                            {{-- Twitter / X --}}
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
                            target="_blank" class="hover:opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                    image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                    viewBox="0 0 512 512" class="w-[1em] h-[1em]">
                                    <path d="M256 0c141.385 0 256 114.615 256 256S397.385 512 256 512 0 397.385 0 256 114.615 0 256 0z"/>
                                    <path fill="#fff" fill-rule="nonzero" d="M318.64 157.549h33.401l-72.973 83.407 85.85 113.495h-67.222l-52.647-68.836-60.242 68.836h-33.423l78.052-89.212-82.354-107.69h68.924l47.59 62.917 55.044-62.917zm-11.724 176.908h18.51L205.95 176.493h-19.86l120.826 157.964z"/>
                                </svg>
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
                            target="_blank" class="hover:opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#25D366" class="w-[1em] h-[1em]">
                                    <path d="M12.04 0C5.405 0 0 5.405 0 12.04c0 2.124.552 4.2 1.6 6.04L0 24l6.127-1.6A11.95 11.95 0 0 0 12.04 24c6.635 0 12.04-5.405 12.04-11.96C24.08 5.405 18.675 0 12.04 0zm0 21.84a9.72 9.72 0 0 1-5.16-1.48l-.368-.22-3.64.96.976-3.52-.24-.38A9.77 9.77 0 0 1 2.32 12c0-5.36 4.36-9.72 9.72-9.72s9.72 4.36 9.72 9.72-4.36 9.84-9.72 9.84zm5.28-7.28c-.28-.14-1.64-.8-1.88-.88-.24-.08-.42-.12-.6.12-.18.24-.7.88-.86 1.06-.16.18-.32.2-.6.08-.28-.14-1.16-.43-2.2-1.38-.8-.72-1.34-1.6-1.5-1.88-.16-.28-.02-.44.12-.58.12-.12.28-.32.42-.48.14-.16.18-.28.28-.46.1-.18.04-.34-.02-.48-.08-.14-.6-1.44-.82-1.98-.22-.54-.44-.46-.6-.46h-.5c-.16 0-.46.06-.7.34-.24.28-.92.9-.92 2.2s.94 2.56 1.06 2.74c.14.18 1.86 2.82 4.5 3.94.63.28 1.12.44 1.5.56.63.2 1.2.18 1.64.12.5-.08 1.64-.66 1.88-1.3.24-.64.24-1.2.16-1.32-.08-.12-.26-.18-.54-.32z"/>
                                </svg>
                            </a>

                            {{-- Copy Link --}}
                            <button onclick="copyLink()" class="hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 122.88" class="w-[1em] h-[1em]" fill="currentColor">
                                    <path d="M60.54,34.07A7.65,7.65,0,0,1,49.72,23.25l13-12.95a35.38,35.38,0,0,1,49.91,0l.07.08a35.37,35.37,0,0,1-.07,49.83l-13,12.95A7.65,7.65,0,0,1,88.81,62.34l13-13a20.08,20.08,0,0,0,0-28.23l-.11-.11a20.08,20.08,0,0,0-28.2.07l-12.95,13Zm14,3.16A7.65,7.65,0,0,1,85.31,48.05L48.05,85.31A7.65,7.65,0,0,1,37.23,74.5L74.5,37.23ZM62.1,89.05A7.65,7.65,0,0,1,72.91,99.87l-12.7,12.71a35.37,35.37,0,0,1-49.76.14l-.28-.27a35.38,35.38,0,0,1,.13-49.78L23,50A7.65,7.65,0,1,1,33.83,60.78L21.12,73.49a20.09,20.09,0,0,0,0,28.25l0,0a20.07,20.07,0,0,0,28.27,0L62.1,89.05Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Tombol kembali --}}
                    <div class="mt-12">
                        @php
                            $previous = url()->previous();
                            $beritaIndex = route('berita.index');
                            $home = route('dashboard.index');
                        @endphp

                        <a href="{{ str_contains($previous, 'berita') ? $beritaIndex : $home }}"
                           class="inline-flex items-center px-5 py-2 bg-gray-800 hover:bg-black text-white text-sm font-medium rounded-md shadow transition">
                            <i class="bi-chevron-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>

                {{-- ====== SIDEBAR (1/3) ====== --}}
                <aside class="lg:col-span-1 space-y-8">

                    {{-- Popular / Recent --}}
                    <div x-data="{ tab: 'popular' }" class="bg-white border border-gray-200 rounded-lg shadow-sm">

                        {{-- Tab Button --}}
                        <div class="flex border-b text-sm font-medium">
                            <button
                                @click="tab = 'popular'"
                                :class="tab === 'popular' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600'"
                                class="w-1/2 px-4 py-2 text-center">
                                Popular
                            </button>
                            <button
                                @click="tab = 'recent'"
                                :class="tab === 'recent' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600'"
                                class="w-1/2 px-4 py-2 text-center">
                                Recent
                            </button>
                        </div>

                        {{-- Konten Popular --}}
                        <div x-show="tab === 'popular'" class="divide-y">
                            @foreach($popular as $item)
                                <a href="{{ route('berita.show', $item->id) }}" class="flex gap-3 p-3 hover:bg-gray-50">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-14 h-14 object-cover rounded">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $item->judul }}</h3>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Konten Recent --}}
                        <div x-show="tab === 'recent'" class="divide-y">
                            @foreach($recent as $item)
                                <a href="{{ route('berita.show', $item->id) }}" class="flex gap-3 p-3 hover:bg-gray-50">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-14 h-14 object-cover rounded">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $item->judul }}</h3>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div id="copyToast"
         class="hidden fixed top-6 left-1/2 transform -translate-x-1/2 bg-white text-gray-700 px-6 py-3 rounded-lg shadow-lg text-sm font-medium opacity-0 transition-opacity duration-500 z-50">
        ✅ Link berita berhasil disalin
    </div>

    <script>
        function copyLink() {
            navigator.clipboard.writeText("{{ request()->fullUrl() }}");
            let toast = document.getElementById('copyToast');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('opacity-100'), 10);
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 3000);
        }
    </script>

</x-app-layout>