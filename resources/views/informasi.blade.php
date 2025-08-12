<x-app-layout>

    @section('title', 'INFORMASI | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA HEADER INFORMASI --}}
            <div class="shadow rounded-lg p-6 mb-10 relative" style="background-color: rgba(255, 255, 255, 0.50); min-height: 64px;">
                {{-- Judul dan Tombol Tambah --}}
                <div class="relative flex items-center justify-center border-b pb-2 mb-8">
                    <h2 class="text-2xl font-bold text-[#2c3e50] flex items-center gap-2">
                        <i class="bi bi-calendar-event text-[#2c3e50]"></i>
                        INFORMASI
                    </h2>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-0 top-1">
                                <a href="{{ route('informasi.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                <i class="bi bi-plus-circle text-base "></i>
                                    Tambah Informasi
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
                {{-- Notifikasi --}}
                @if (session('success'))
                    <div id="success-alert" class="mt-4 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500">
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

                {{-- Grid Informasi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 items-start">
                    @forelse ($informasi as $data)
                        <div
                            x-data="{ showDetailBtn: false }"
                            class="bg-gradient-to-br from-[#dfe0e8] to-[#f0f4f8] border border-gray shadow-md rounded-lg flex flex-col justify-between cursor-pointer hover:scale-105 transition duration-300 ease-in-out relative"
                        >
                            {{-- Gambar (jika ada) --}}
                            @if ($data->foto)
                                <img src="{{ asset('storage/' . $data->foto) }}" alt="{{ $data->judul }}" class="w-full max-h-48 object-cover rounded-t-lg">
                            @endif

                            {{-- Konten teks --}}
                            <div class="p-4 flex flex-col flex-grow overflow-hidden {{ !$data->foto ? 'rounded-t-lg' : '' }}"
                                :class="showDetailBtn ? 'h-auto' : 'h-[200px]'">
                                <p class="text-sm text-gray-500 flex items-center gap-1 mb-2">
                                    {{-- Tanggal --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="mt-[1px]">
                                        {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </p>

                                <h3 class="text-lg font-bold text-gray-800 mb-[2px]">
                                    {{ $data->judul }}
                                </h3>

                                {{-- Deskripsi --}}
                                <p class="text-gray-700 text-base leading-relaxed text-justify break-words transition-all duration-300"
                                    :class="showDetailBtn ? '' : 'line-clamp-3'">
                                    {!! strip_tags($data->deskripsi) !!}
                                </p>
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="px-4 pb-4 pt-1 flex items-center justify-between">
                                <button @click.stop="showDetailBtn = !showDetailBtn"
                                    class="bg-[#2c3e50] hover:bg-[#1a252f] text-white px-4 py-2 rounded-md text-sm font-medium shadow-md transition duration-300">
                                    <span x-text="showDetailBtn ? 'Tutup' : 'Baca Lebih Lanjut'"></span>
                                </button>

                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex gap-4">
                                            <a href="{{ route('informasi.edit', $data->id) }}" @click.stop
                                                class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            <button type="button" @click.stop
                                                class="text-red-600 hover:text-red-800 transition"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusInformasiModal{{ $data->id }}"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-3 text-center">Belum ada informasi yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>

            {{-- Modal Konfirmasi Hapus --}}
            @foreach($informasi as $data)
                <div class="modal fade" id="hapusInformasiModal{{ $data->id }}" tabindex="-1" aria-labelledby="hapusInformasiLabel{{ $data->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="hapusInformasiLabel{{ $data->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data <strong>{{ $data->judul }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('informasi.destroy', $data->id) }}" method="POST">
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

            {{-- Media Sosial dan Kontak --}}
            <div class="mt-16 mb-16 bg-gradient-to-b from-[#dfe0e8] to-white rounded-lg px-6 py-10 text-center">
                <h2 class="text-2xl font-bold text-[#2c3e50] mb-6">Media Sosial dan Kontak</h2>
                <div class="flex flex-wrap justify-center gap-6 mb-10 mt-5 ">
                    <a href="https://www.instagram.com/humas_setukpa?igsh=MTE3dWU4emFjYjFtdg==" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                        <i class="bi bi-instagram text-2xl mb-2"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="https://youtube.com/@humassetukpa566?si=b4Ret7QbAoK5vW39" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                        <i class="bi bi-youtube text-2xl mb-2"></i>
                        <span>YouTube</span>
                    </a>
                    <a href="https://www.tiktok.com/@humas_setukpa?_t=ZS-8yOduXJ7cs4&_r=1" class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                        <i class="bi bi-tiktok text-2xl mb-2"></i>
                        <span>TikTok</span>
                    </a>
                    <div x-data="{ modalOpen: false }">
                        <button @click="modalOpen = true"
                            class="bg-white shadow p-4 h-32 rounded-lg w-28 text-sm flex flex-col items-center justify-center hover:shadow-md transition hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer">
                            <i class="bi bi-telephone text-2xl mb-2"></i>
                            <span>Telpon</span>
                        </button>

                        <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
                            <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                                <h2 class="text-lg font-semibold mb-4">Konfirmasi Panggilan</h2>
                                <p>Apakah Anda ingin menelepon <strong>062266225481</strong>?</p>
                                <div class="mt-6 flex justify-end gap-3">
                                    <a href="tel:062266225481"
                                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                        Panggil
                                    </a>
                                    <button @click="modalOpen = false" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Peta --}}
            <div class="mt-10 mb-10 w-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.305004477184!2d106.90528948715817!3d-6.911367899999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848356fffffff%3A0xf319c6be506068e7!2sEducational%20Establishment%20Officer!5e0!3m2!1sen!2sid!4v1753245232528!5m2!1sen!2sid"
                        width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md">
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>