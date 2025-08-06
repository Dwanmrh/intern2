<x-app-layout>

    @section('title', 'Dashboard | SETUKPA LEMDIKLAT POLRI')

    <div class="@auth py-5 @else py-2 @endauth">
        <div class="container">

            {{-- Header & Tombol Tambah --}}
            <div class="flex items-center justify-between mb-4 relative">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="absolute right-0">
                            <a href="{{ route('dashboard.create') }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                               <i class="bi bi-plus-circle text-base "></i>
                                Tambah Preview
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Carousel --}}
            @php
                $validDashboards = $dashboards->filter(fn($item) => !empty($item->file));

                // Pindahkan Preview 3 ke posisi pertama jika ada
                $preview3 = $validDashboards->firstWhere('judul', 'Preview 3');
                if ($preview3) {
                    $validDashboards = collect([$preview3])
                        ->merge($validDashboards->filter(fn($item) => $item->judul !== 'Preview 3'));
                }

                $validDashboards = $validDashboards->values(); // Reset index agar $index === 0 tetap akurat
            @endphp

            <div id="dashboardCarousel" class="carousel slide mb-5 position-relative" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($validDashboards as $index => $item)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            @if(\Illuminate\Support\Str::endsWith($item->file, ['.mp4', '.mov', '.webm']))
                                <video class="d-block w-100 rounded" autoplay loop muted style="object-fit: cover; max-height: 480px;">
                                    <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $item->file) }}"
                                     class="d-block w-100 rounded" style="object-fit: cover; max-height: 480px;" alt="Preview">
                            @endif

                            {{-- Tombol Edit & Hapus --}}
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <div class="absolute top-3 right-3 flex gap-2 z-30">
                                        <a href="{{ route('dashboard.edit', $item->id) }}"
                                           class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm shadow"
                                           title="Edit">
                                            Edit
                                        </a>

                                        <!-- Trigger Modal -->
                                        <button type="button"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm shadow"
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

            {{-- Section Berita --}}
            <div class="card mb-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fw-bold" style="color: #2c3e50; font-size: 1.55rem;">Berita</h2>
                    <a href="{{ route('berita.index') }}" class="text-decoration-none fw-bold d-flex align-items-center gap-1" style="color: #2c3e50; font-size: 0.95rem;">
                        Lihat Lebih Lanjut <i class="bi bi-box-arrow-up-right" style="font-size: 1.05rem;"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($beritas as $berita)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $berita->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Berita">
                                    <div class="card-body">
                                        <p class="text-muted small">
                                            <i class="bi bi-calendar"></i>
                                            {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d M Y') }}
                                        </p>
                                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($berita->judul), 50) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Belum ada berita.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Section Galeri --}}
            <div class="card mb-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fw-bold" style="color: #2c3e50; font-size: 1.55rem;">Galeri</h2>
                    <a href="{{ route('galeri.index') }}" class="text-decoration-none fw-bold d-flex align-items-center gap-1" style="color: #2c3e50; font-size: 0.95rem;">
                        Lihat Lebih Lanjut <i class="bi bi-box-arrow-up-right" style="font-size: 1.05rem;"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($galeris as $galeri)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $galeri->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Galeri">
                                    <div class="card-body">
                                        <p class="text-muted small">
                                            <i class="bi bi-calendar"></i>
                                            {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('l, d M Y') }}
                                        </p>
                                        <p class="card-text">{{ $galeri->judul }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Belum ada galeri.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
