<x-app-layout>
    @section('title', 'BERITA | SETUKPA LEMDIKLAT POLRI')

    <div class="pt-4 pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gradient-to-r from-slate-600 via-slate-700 to-slate-800
                        text-white rounded-2xl shadow-lg px-6 py-8 mb-10 overflow-hidden">

                <div class="absolute inset-0
                            bg-[url('/assets/images/header.jpg')]
                            bg-cover bg-center opacity-15 rounded-2xl">
                </div>

                <div class="relative text-center">
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-wide drop-shadow mb-2">
                        <i class="bi bi-newspaper mr-2"></i> NEWS & HIGHLIGHTS
                    </h2>
                    <p class="text-sm md:text-base text-gray-200">
                        Official Updates from Setukpa Lemdiklat Polri
                    </p>
                </div>

                {{-- Tombol Tambah Data  --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('berita.create') }}"
                           class="absolute right-6 top-6
                                  bg-slate-500 hover:bg-slate-600
                                  text-white px-4 py-1.5 rounded-lg text-sm shadow-md font-semibold
                                  transition inline-flex items-center">
                            <i class="bi bi-plus-circle text-base mr-1"></i>
                            Tambah Berita
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                    <div class="modal fade" id="notifModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content text-center p-4" style="border-radius: 10px; background-color: #ffffff; color: #065f46;">
                                {{-- Icon Centang --}}
                                <div class="mb-2">
                                    <div class="bg-green-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                {{-- Pesan --}}
                                <p class="mb-2 text-sm font-medium">{{ session('success') }}</p>
                                {{-- Tombol --}}
                                <button type="button" class="btn btn-success btn-sm px-3 py-1" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            new bootstrap.Modal(document.getElementById('notifModal')).show();
                        });
                    </script>
                @endif

            {{-- GRID BERITA --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($beritas as $berita)
                    <div data-href="{{ route('berita.show', $berita->id) }}"
                        class="group bg-white rounded-xl shadow-md overflow-hidden
                                flex flex-col cursor-pointer hover:shadow-xl
                                transition transform hover:-translate-y-2 relative card-berita
                                w-full max-w-sm mx-auto">

                        {{-- FOTO --}}
                        <div class="aspect-[2/1] overflow-hidden bg-gray-100 relative">
                            @if ($berita->foto)
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                     alt="{{ $berita->judul }}"
                                     class="w-full h-full object-cover object-center">
                                <span class="absolute bottom-2 left-2 bg-slate-600 text-white text-xs px-3 py-1 rounded-full shadow">
                                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            @else
                                <x-placeholder-foto />
                            @endif
                        </div>

                        {{-- KONTEN --}}
                        <div class="flex flex-col flex-1 p-6">
                            {{-- Judul --}}
                            <h3 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2
                                    transition-colors group-hover:text-blue-600">
                                {{ $berita->judul }}
                            </h3>

                            {{-- Isi ringkas --}}
                            <p class="text-sm text-gray-600 mb-6 line-clamp-3 flex-1">
                                {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 150) }}
                            </p>

                            {{-- Footer --}}
                            <div class="mt-auto flex justify-between items-center pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <i class="bi bi-eye-fill"></i>
                                    <span>{{ $berita->views }} views</span>
                                </div>

                                <div class="flex items-center gap-2">

                                    {{-- Tombol Like --}}
                                    @auth
                                        <button class="btn-like flex items-center gap-1 text-pink-600 hover:text-pink-700 transition"
                                                data-id="{{ $berita->id }}"
                                                onclick="event.stopPropagation()">
                                            <i class="bi {{ $berita->isLikedBy(Auth::user()) ? 'bi-heart-fill' : 'bi-heart' }} text-lg"></i>
                                            <span class="like-count text-sm">{{ $berita->likes()->count() }}</span>
                                        </button>
                                    @else
                                        {{-- Guest hanya lihat total like --}}
                                        <div class="flex items-center gap-1 text-gray-400 cursor-not-allowed"
                                            title="Login untuk memberi Like">
                                            <i class="bi bi-heart text-lg"></i>
                                            <span class="like-count text-sm">{{ $berita->likes()->count() }}</span>
                                        </div>
                                    @endauth

                                    {{-- Button Edit Delete --}}
                                    @auth
                                        @if(Auth::user()->role === 'admin')
                                            <div class="flex gap-2">
                                                {{-- Edit --}}
                                                <a href="{{ route('berita.edit', $berita->id) }}"
                                                onclick="event.stopPropagation()"
                                                class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100
                                                        shadow transition" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0
                                                            002 2h12a2 2 0 002-2v-5M18.5
                                                            2.5a2.121 2.121 0 113 3L12 15l-4
                                                            1 1-4 9.5-9.5z"/>
                                                    </svg>
                                                </a>

                                                {{-- Hapus --}}
                                                <button type="button"
                                                        onclick="event.stopPropagation()"
                                                        class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100
                                                                shadow transition"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusBeritaModal{{ $berita->id }}"
                                                        title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0
                                                            0116.138 21H7.862a2 2 0
                                                            01-1.995-1.858L5 7m5 4v6m4-6v6M9
                                                            7h6m-3-4v4"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 col-span-3 text-center">Belum ada berita yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>

        {{-- Modal Hapus Berita --}}
        @foreach ($beritas as $berita)
            <div class="modal fade" id="hapusBeritaModal{{ $berita->id }}" tabindex="-1"
                aria-labelledby="hapusLabel{{ $berita->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered custom-modal">
                    <div class="modal-content rounded-2xl shadow-lg border-0">

                        {{-- Header --}}
                        <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                            <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusLabel{{ $berita->id }}">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                                Konfirmasi Hapus
                            </h5>
                            <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        {{-- Body --}}
                        <div class="modal-body text-center py-3 px-3">
                            <i class="bi bi-trash3-fill text-danger fs-3 mb-2"></i>
                            <p class="fw-semibold text-gray-700 mt-4 mb-2" style="font-size: 0.9rem;">
                                Apakah anda yakin ingin menghapus berita <br>
                                <span class="text-danger">"{{ $berita->judul }}"</span>?
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3 py-1 rounded-pill shadow-sm">
                                    Hapus
                                </button>
                            </form>
                            <button type="button"
                                    class="btn btn-primary btn-sm px-3 py-1 rounded-pill shadow-sm"
                                    data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Klik card → ke detail
        document.querySelectorAll(".card-berita").forEach(function(card) {
            card.addEventListener("click", function() {
                window.location.href = this.dataset.href;
            });
        });

        // Tombol Like AJAX
        document.querySelectorAll(".btn-like").forEach(function(btn) {
            btn.addEventListener("click", function(e) {
                e.stopPropagation(); // biar ga klik card
                let beritaId = this.dataset.id;

                fetch(`/like/${beritaId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "liked") {
                        this.querySelector("i").classList.remove("bi-heart");
                        this.querySelector("i").classList.add("bi-heart-fill");
                    } else {
                        this.querySelector("i").classList.remove("bi-heart-fill");
                        this.querySelector("i").classList.add("bi-heart");
                    }
                    this.querySelector(".like-count").textContent = data.total_likes;
                });
            });
        });
    });
    </script>

</x-app-layout>
