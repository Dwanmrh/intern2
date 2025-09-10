<x-app-layout>
    @section('title', 'BERANDA | SETUKPA LEMDIKLAT POLRI')

    <div class="{{ Auth::check() ? 'py-3' : 'py-2' }}">
        <div class="container">

            {{-- Header & Tombol Tambah --}}
            <div class="flex items-center justify-between mb-4 relative">
                @auth
                    @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                        <div class="absolute right-0 -top-5">
                            <a href="{{ route('dashboard.create') }}"
                               class="bg-[#800000] hover:bg-[#660000]
                                      text-white px-4 py-2 rounded-md text-sm shadow-md
                                      transition duration-300 ease-in-out">
                                <i class="bi bi-plus-circle text-base"></i>
                                Tambah Preview
                            </a>
                        </div>
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

            {{-- Carousel --}}
            @php
                // Ambil semua data dashboard, tidak filter file kosong
                $validDashboards = $dashboards;

                // Pindahkan Gerbang Setukpa ke posisi pertama jika ada
                $preview3 = $validDashboards->firstWhere('judul', 'Gerbang Setukpa');
                if ($preview3) {
                    $validDashboards = collect([$preview3])
                        ->merge($validDashboards->filter(fn($item) => $item->judul !== 'Gerbang Setukpa'));
                }

                $validDashboards = $validDashboards->values();
            @endphp

            <div id="dashboardCarousel" class="carousel slide mb-5 position-relative -mt-2" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($validDashboards as $index => $item)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            @if($item->file)
                                @if(\Illuminate\Support\Str::endsWith($item->file, ['.mp4', '.mov', '.webm']))
                                    <video class="d-block w-100 rounded" autoplay loop muted style="object-fit: cover; max-height: 550px;">
                                        <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ asset('storage/' . $item->file) }}"
                                         class="d-block w-100 rounded" style="object-fit: cover; max-height: 550px;" alt="Preview">
                                @endif
                            @else
                                {{-- Placeholder kalau file kosong --}}
                                <div class="d-flex justify-content-center align-items-center bg-secondary text-white"
                                     style="height: 300px; border-radius: 8px;">
                                    <p class="mb-0">Tidak ada file</p>
                                </div>
                            @endif

                            {{-- Tombol Edit & Hapus --}}
                            @auth
                                @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                                    <div class="absolute top-3 right-3 flex gap-2 z-30">

                                        {{-- Edit Button --}}
                                        <a href="{{ route('dashboard.edit', $item->id) }}"
                                           class="bg-transparent border border-yellow-400 text-white
                                                  hover:!bg-yellow-400 hover:!text-white
                                                  px-3 py-1 rounded text-sm shadow
                                                  transition-colors duration-300 ease-in-out"
                                           title="Edit">
                                            Edit
                                        </a>

                                        {{-- Hapus Button --}}
                                        <button type="button"
                                                class="bg-transparent border border-red-600 text-white
                                                       hover:!bg-red-600 hover:!text-white
                                                       px-3 py-1 rounded text-sm shadow
                                                       transition-colors duration-300 ease-in-out"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusModal{{ $item->id }}">
                                            Hapus
                                        </button>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>

                @if ($validDashboards->count() > 1)
                    <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
                        <i class="bi bi-chevron-left fs-4 text-white"></i>
                    </button>
                    <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
                        <i class="bi bi-chevron-right fs-4 text-white"></i>
                    </button>
                @endif
            </div>

            {{-- Modal Konfirmasi Hapus per Item --}}
            @foreach($validDashboards as $item)
                <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered custom-modal">
                        <div class="modal-content rounded-2xl shadow-lg border-0">

                            {{-- Header --}}
                            <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                                <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusModalLabel{{ $item->id }}">
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
                                    Apakah anda yakin ingin menghapus data <br>
                                    <span class="text-danger">"{{ $item->judul }}"</span>?
                                </p>
                            </div>

                            {{-- Footer --}}
                            <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                                <form action="{{ route('dashboard.destroy', $item->id) }}" method="POST">
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

            {{-- Section Berita --}}
            <div class="mb-5 shadow rounded-lg p-6 bg-gradient-to-b from-white to-blue-50 border-t-4 border-blue-400">

                {{-- Header --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-[1.35rem] text-[#2c3e50]">NEWS</h2>
                    <a href="{{ route('berita.index') }}"
                       class="flex items-center gap-1 font-bold text-blue-600 text-[0.95rem] hover:underline">
                        Read More
                        <i class="bi bi-box-arrow-up-right text-[1.05rem]"></i>
                    </a>
                </div>

                {{-- Body --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @forelse($beritas as $berita)
                        <a href="{{ route('berita.show', $berita->id) }}" class="block text-dark no-underline">
                            <div class="shadow-sm rounded-lg overflow-hidden bg-white
                                        hover:shadow-lg transition-transform duration-300 ease-in-out
                                        transform hover:scale-105 h-full">
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                     alt="Berita"
                                     class="w-full h-[180px] object-cover">
                                <div class="p-3">
                                    <p class="text-gray-500 text-sm mb-1 flex items-center gap-1">
                                        <i class="bi bi-calendar text-blue-500"></i>
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d M Y') }}
                                    </p>
                                    <p class="font-semibold text-gray-800">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->judul), 50) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-gray-500">Belum ada berita.</p>
                    @endforelse
                </div>
            </div>

            {{-- Section Logo Link Terkait --}}
            @if($links->count() || (Auth::check() && Auth::user()->role === 'admin, super_admin'))
                <div class="mb-10 mt-8 shadow rounded-lg p-8 bg-white border-t-4 border-blue-400 text-center">

                    {{-- Header --}}
                    <div class="grid grid-cols-3 items-center mb-6">
                        <div></div> {{-- kosong biar judul bisa center --}}

                        {{-- Judul di tengah --}}
                        <div class="text-center">
                            <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                                    bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                                    px-6 py-1 rounded-xl shadow-md">
                                    <i class="bi bi-link-45deg text-white text-xl md:text-2xl"></i>
                                RELATED UNIT
                            </h2>
                        </div>

                        {{-- Tombol di kanan --}}
                        <div class="flex justify-end">
                            @auth
                                @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                                    <a href="{{ route('dashboard.link.create') }}"
                                       class="bg-[#800000] hover:bg-[#660000]
                                              text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                              transition duration-300 ease-in-out inline-flex items-center">
                                        <i class="bi bi-plus-circle text-sm mr-1"></i>
                                        Tambah Link
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    {{-- Grid Logo --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-10 place-items-center">
                        @foreach($links as $link)
                            <div class="flex flex-col items-center gap-2">
                                <a href="{{ $link->url }}" target="_blank"
                                   class="hover:scale-105 transition transform">
                                    @if ($link->logo)
                                        <img src="{{ asset('storage/' . $link->logo) }}"
                                             alt="{{ $link->nama }}"
                                             class="max-h-20 object-contain">
                                    @else
                                        <div class="w-20 h-20 flex items-center justify-center bg-gray-100 rounded-full text-gray-500 text-sm">
                                            Tanpa Logo
                                        </div>
                                    @endif
                                </a>

                                <span class="font-semibold text-sm text-[#2c3e50] uppercase tracking-wide">
                                    {{ $link->nama }}
                                </span>

                                {{-- Tombol Edit / Hapus --}}
                                @auth
                                    @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                                        <div class="flex justify-center items-center gap-3 mt-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('dashboard.link.edit', $link->id) }}"
                                               class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition"
                                               title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0
                                                              002 2h12a2 2 0 002-2v-5M18.5
                                                              2.5a2.121 2.121 0 113 3L12 15l-4
                                                              1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            {{-- Tombol Hapus (trigger modal) --}}
                                            <button type="button"
                                                    class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusLinkModal{{ $link->id }}"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0
                                                              0116.138 21H7.862a2 2 0
                                                              01-1.995-1.858L5 7m5
                                                              4v6m4-6v6M9 7h6m-3-4v4"/>
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Modal Konfirmasi Hapus Link --}}
                                        <div class="modal fade" id="hapusLinkModal{{ $link->id }}" tabindex="-1"
                                            aria-labelledby="hapusLinkLabel{{ $link->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered custom-modal">
                                                <div class="modal-content rounded-2xl shadow-lg border-0">

                                                    {{-- Header --}}
                                                    <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                                                        <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusLinkLabel{{ $link->id }}">
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
                                                            Apakah anda yakin ingin menghapus link <br>
                                                            <span class="text-danger">"{{ $link->nama }}"</span>?
                                                        </p>
                                                    </div>

                                                    {{-- Footer --}}
                                                    <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                                                        <form action="{{ route('dashboard.link.destroy', $link->id) }}" method="POST">
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
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
