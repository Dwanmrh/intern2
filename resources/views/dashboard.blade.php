<x-app-layout>

    @section('title', 'HOME | SETUKPA LEMDIKLAT POLRI')

    <div class="@auth py-3 @else py-2 @endauth">
        <div class="container">

            {{-- Header & Tombol Tambah --}}
            <div class="flex items-center justify-between mb-4 relative">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="absolute right-0">
                            <a href="{{ route('dashboard.create') }}"
                            class="bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700 hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800 text-white px-4 py-2 rounded-md text-sm shadow-md transition duration-300 ease-in-out">
                                <i class="bi bi-plus-circle text-base "></i>
                                Tambah Preview
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div id="success-alert" class="mt-6 mb-6 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function () {
                        let alertBox = document.getElementById('success-alert');
                        if (alertBox) {
                            alertBox.style.opacity = '0'; // efek fade out
                            setTimeout(() => alertBox.remove(), 500); // hapus setelah fade
                        }
                    }, 5000); // 5000ms = 5 detik
                </script>
            @endif

            {{-- Carousel --}}
            @php
                $validDashboards = $dashboards->filter(fn($item) => !empty($item->file));

                // Pindahkan Gerbang Setukpa ke posisi pertama jika ada
                $preview3 = $validDashboards->firstWhere('judul', 'Gerbang Setukpa');
                if ($preview3) {
                    $validDashboards = collect([$preview3])
                        ->merge($validDashboards->filter(fn($item) => $item->judul !== 'Gerbang Setukpa'));
                }

                $validDashboards = $validDashboards->values(); // Reset index agar $index === 0 tetap akurat
            @endphp

            <div id="dashboardCarousel" class="carousel slide mb-5 position-relative" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($validDashboards as $index => $item)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            @if(\Illuminate\Support\Str::endsWith($item->file, ['.mp4', '.mov', '.webm']))
                                <video class="d-block w-100 rounded" autoplay loop muted style="object-fit: cover; max-height: 550px;">
                                    <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $item->file) }}"
                                     class="d-block w-100 rounded" style="object-fit: cover; max-height: 550px;" alt="Preview">
                            @endif

                                                        {{-- Tombol Edit & Hapus --}}
                                                        @auth
                                @if(Auth::user()->role === 'admin')
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
                <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="hapusModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data <strong>{{ $item->judul }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('dashboard.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- PEMBATAS --}}
            <div class="pt-10 mt-10 border-t border-gray-200"></div>

            {{-- Section Berita --}}
            <div class="mb-5 shadow rounded-lg p-6 bg-gradient-to-b from-white to-blue-50 border-t-4 border-blue-400">
                {{-- Header --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-[1.55rem] text-[#2c3e50]">Berita</h2>
                    <a href="{{ route('berita.index') }}"
                    class="flex items-center gap-1 font-bold text-[#2c3e50] text-[0.95rem] hover:underline">
                        Lihat Lebih Lanjut
                        <i class="bi bi-box-arrow-up-right text-[1.05rem]"></i>
                    </a>
                </div>

                {{-- Body --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @forelse($beritas as $berita)
                        <a href="{{ route('berita.show', $berita->id) }}" class="block text-dark no-underline">
                            <div
                                class="shadow-sm rounded-lg overflow-hidden bg-white hover:shadow-lg transition-transform duration-300 ease-in-out transform hover:scale-105 h-full">
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                    alt="Berita"
                                    class="w-full h-[180px] object-cover">
                                <div class="p-3">
                                    <p class="text-gray-500 text-sm mb-1 flex items-center gap-1">
                                        <i class="bi bi-calendar"></i>
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
            @if($links->count())
                <div class="mb-10 mt-8 shadow rounded-lg p-8 bg-white border-t-4 border-blue-400 text-center">

                    {{-- Header --}}
                    <div class="mb-6">
                        <p class="text-sm uppercase text-gray-500 tracking-wide">Related Unit</p>
                        <h2 class="font-bold text-2xl text-[#2c3e50]">INSTANSI TERKAIT</h2>
                    </div>

                    {{-- Grid Logo --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-10 place-items-center">
                        @foreach($links as $link)
                            <a href="{{ $link->kategori === 'sadiklat' ? route('sadiklat.index') : $link->url }}"
                            target="_blank"
                            class="flex flex-col items-center gap-2 hover:scale-105 transition transform">

                                @if ($link->logo)
                                    <img src="{{ asset('storage/' . $link->logo) }}"
                                        alt="{{ $link->nama }}"
                                        class="max-h-20 object-contain">
                                @else
                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-100 rounded-full text-gray-500 text-sm">
                                        Tanpa Logo
                                    </div>
                                @endif

                                <span class="font-semibold text-sm text-[#2c3e50] uppercase tracking-wide">
                                    {{ $link->nama }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>