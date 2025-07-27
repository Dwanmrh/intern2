<x-app-layout>
    <div class="py-5">
        <div class="container">

{{-- Tombol Tambah --}}
@auth
    @if(Auth::user()->role === 'admin')
        <div class="mb-3 text-end position-relative z-10">
            <a href="{{ route('dashboard.create') }}" class="btn btn-primary">
                + Tambah Preview
            </a>
        </div>
    @endif
@endauth

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Carousel --}}
            @php
                $validDashboards = $dashboards->filter(fn($item) => !empty($item->file))->values();
            @endphp

            <div id="dashboardCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($validDashboards as $index => $item)
    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
        @if(\Illuminate\Support\Str::endsWith($item->file, ['.mp4', '.mov', '.webm']))
            <video class="d-block w-100 rounded" autoplay loop muted style="object-fit: cover; max-height: 480px;>
                <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
            </video>
        @else
            <img src="{{ asset('storage/' . $item->file) }}" class="d-block w-100 rounded" style="object-fit: cover; max-height: 480px;" alt="Preview">
        @endif

        {{-- Tombol Edit & Hapus untuk setiap item --}}
        @auth
    @if(Auth::user()->role === 'admin')
        {{-- Tombol Edit & Hapus untuk setiap item --}}
        <div class="position-absolute top-0 end-0 p-3 z-10">
            <a href="{{ route('dashboard.edit', $item->id) }}"
               class="btn btn-warning btn-sm shadow-sm">Edit</a>

            <form action="{{ route('dashboard.destroy', $item->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus preview ini?');"
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm shadow-sm">Hapus</button>
            </form>
        </div>
    @endif
@endauth
    </div>
@endforeach
    </div>

    @if ($validDashboards->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>

            {{-- Section Berita --}}
            <div class="card mb-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Berita</h5>
                    <a href="{{ route('berita') }}" class="btn btn-link btn-sm">Lihat Lebih Lanjut</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($beritas as $berita)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $berita->foto) }}" class="card-img-top" alt="Berita">
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
                    <h5 class="mb-0">Galeri</h5>
                    <a href="{{ route('galeri.index') }}" class="btn btn-link btn-sm">Lihat Lebih Lanjut</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($galeris as $galeri)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $galeri->foto) }}" class="card-img-top" alt="Galeri">
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
