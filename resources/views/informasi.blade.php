<x-app-layout>
    @section('title', 'INFORMASI | SETUKPA LEMDIKLAT POLRI')

    <div class="pt-4 pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Notifikasi --}}
        @if (session('success'))
                    <div id="success-alert"
                        class="mt-4 mb-4 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            let alertBox = document.getElementById('success-alert');
                            if (alertBox) {
                                alertBox.style.opacity = '0';
                                setTimeout(() => alertBox.remove(), 500);
                            }
                        }, 5000);
                    </script>
                @endif

            {{-- CARD PERSYARATAN --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                    bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                            px-4 py-1 rounded-xl shadow-md">
                        <i class="bi bi-journal-check text-white text-xl md:text-lg"></i>
                        SETUKPA ADMISSION REQUIRMENTS
                    </h2>
                </div>

            {{-- SYARAT UMUM --}}
            <div x-data="{ open: true }"
                class="mb-6 border rounded-lg pt-8">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-6 py-3
                            bg-gradient-to-r from-[#1E293B] to-[#2C3E50] text-yellow-400 font-bold rounded-t-lg hover:opacity-90 transition">
                    <span>SYARAT UMUM</span>
                    <i :class="open ? 'bi bi-chevron-up' : 'bi bi-chevron-down'"></i>
                </button>
                <div x-show="open" x-collapse
                    class="p-6 text-gray-800 leading-relaxed space-y-2 bg-white">
                    <ul class="list-decimal pl-6 space-y-2">
                        <li>Anggota Polri dengan pangkat minimal sesuai ketentuan:
                            <ul class="list-disc pl-6 mt-1">
                                <li>Brigadir MDDP 4 tahun (lulusan S3/S2)</li>
                                <li>Brigadir MDDP 5 tahun (lulusan S1/D4)</li>
                                <li>Bripka MDDP 0 tahun (lulusan D3)</li>
                                <li>Bripka MDDP 1 tahun (lulusan SMA/SMK sederajat)</li>
                            </ul>
                        </li>
                        <li>Usia maksimal 45 tahun (NRP 79 ke bawah tidak dapat mendaftar).</li>
                        <li>Ijazah dari perguruan tinggi terakreditasi minimal B (Pulau Jawa) atau C (luar Jawa).
                            Alternatif: akreditasi “Baik” / IAPS 4.0 / IAPT 3.0 sesuai BAN-PT No.1 Tahun 2022.</li>
                        <li>Diusulkan oleh atasan yang berwenang (dinilai potensial).</li>
                        <li>Memiliki SKHP (Surat Keterangan Hasil Penelitian) dari Bidpropam Polda.</li>
                        <li>Bebas radikalisme, penyimpangan seksual, serta tidak bertentangan dengan norma agama/sosial.</li>
                        <li>Menyatakan siap ditempatkan di seluruh wilayah NKRI (bermaterai).</li>
                    </ul>
                    <p class="mt-4 text-sm text-white">
                        Sumber:
                        <a href="https://www.infopenerimaanpolri.com/2023/11/syarat-lengkap-pendaftaran-sip-bintara.html"
                        class="text-blue-600 hover:underline" target="_blank">
                            infopenerimaanpolri.com
                        </a>
                    </p>
                </div>
            </div>

            {{-- TAHAPAN SELEKSI --}}
            <div x-data="{ open: false }"
                class="mb-6 border rounded-lg shadow bg-white">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-6 py-3
                            bg-gradient-to-r from-[#1E293B] to-[#2C3E50] text-yellow-400 font-bold rounded-t-lg hover:opacity-90 transition">
                    <span>TAHAPAN SELEKSI</span>
                    <i :class="open ? 'bi bi-chevron-up' : 'bi bi-chevron-down'"></i>
                </button>
                <div x-show="open" x-collapse
                    class="p-6 text-gray-800 leading-relaxed space-y-2 bg-white">
                    <ol class="list-decimal pl-6 space-y-2">
                        <li>Pendaftaran online dan verifikasi di Bag SDM Polda/Polres.</li>
                        <li>Verifikasi administrasi tingkat Panda/Subpanpus.</li>
                        <li>Penandatanganan Pakta Integritas.</li>
                        <li>Verifikasi 13 komponen & pemeriksaan kesehatan (Rikkes).</li>
                        <li>Tes Kesamaptaan Jasmani (TKJ).</li>
                        <li>Tes Psikologi.</li>
                        <li>Tes Akademik.</li>
                        <li>Tes Komputer.</li>
                        <li>Sidang kelulusan Panda/Subpanpus.</li>
                        <li>Surat panggilan pendidikan di LAN RI & Setukpa.</li>
                    </ol>
                    <p class="mt-4 text-sm text-white">
                        Sumber:
                        <a href="https://www.infopenerimaanpolri.com/2024/01/persyaratan-sip-polri-2024-dan-tahapan.html"
                        class="text-blue-600 hover:underline" target="_blank">
                            infopenerimaanpolri.com
                        </a>
                    </p>
                </div>
            </div>

            {{-- PENDIDIKAN & OUTCOME --}}
            <div x-data="{ open: false }"
                class="mb-6 border rounded-lg shadow bg-white">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-6 py-3
                            bg-gradient-to-r from-[#1E293B] to-[#2C3E50] text-yellow-400 font-bold rounded-t-lg hover:opacity-90 transition">
                    <span>PENDIDIKAN & OUTCOME</span>
                    <i :class="open ? 'bi bi-chevron-up' : 'bi bi-chevron-down'"></i>
                </button>
                <div x-show="open" x-collapse
                    class="p-6 text-gray-800 leading-relaxed space-y-2 bg-white">
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Durasi pendidikan SIP di Setukpa: <strong>7 bulan</strong>.</li>
                        <li>Lulusan memperoleh pangkat: <strong>Inspektur Polisi Dua (IPDA)</strong>.</li>
                    </ul>
                    <p class="mt-4 text-sm text-white">
                        Sumber:
                        <a href="https://www.infopenerimaanpolri.com/2023/11/syarat-lengkap-pendaftaran-sip-bintara.html"
                        class="text-blue-600 hover:underline" target="_blank">
                            infopenerimaanpolri.com
                        </a>
                    </p>
                </div>
            </div>
            {{-- BUTTON INFORMASI LEBIH LANJUT --}}
            <div class="mt-8 mb-6">
                <a href="https://penerimaan.polri.go.id/" target="_blank" rel="noopener noreferrer"
                    class="cursor-pointer w-full block text-center bg-yellow-500
                        text-black font-extrabold text-sm py-3 rounded-lg shadow-lg
                        hover:bg-yellow-500 hover:scale-[1.02]
                        transition transform duration-300">
                    <i class="bi bi-info-circle mr-2"></i>
                    Learn More
                </a>
            </div>

            {{-- SECTION PANGKAT --}}
            <div class="mt-10 mb-10">
                <div class="text-center mb-8">
                    <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                        bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                        px-6 py-1 rounded-xl shadow-md">
                        <i class="bi bi-award text-white text-xl md:text-lg"></i>
                        SETUKPA STUDENT RANK STRUCTURE
                    </h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">

                    {{-- Foto 1 --}}
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden
                                hover:shadow-lg transition-transform duration-300 ease-in-out
                                transform hover:scale-105 h-full">
                        <div class="flex justify-center items-center h-36 bg-gray-50">
                            <img src="{{ asset('assets/images/Brigpol.png') }}" alt="Brigpol"
                                class="max-h-32 object-contain">
                        </div>
                        <div class="p-3 text-center bg-gradient-to-r from-slate-700 to-slate-900">
                            <p class="font-semibold text-yellow-400 text-sm tracking-wide">Brigadir Polisi</p>
                            <p class="text-yellow-400 text-xs">(Brigadir)</p>
                        </div>
                    </div>

                    {{-- Foto 2 --}}
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden
                                hover:shadow-lg transition-transform duration-300 ease-in-out
                                transform hover:scale-105 h-full">
                        <div class="flex justify-center items-center h-36 bg-gray-50">
                            <img src="{{ asset('assets/images/Bripka.png') }}" alt="Bripka"
                                class="max-h-32 object-contain">
                        </div>
                        <div class="p-3 text-center bg-gradient-to-r from-slate-700 to-slate-900">
                            <p class="font-semibold text-yellow-400 text-sm tracking-wide">Brigadir Kepala Polisi</p>
                            <p class="text-yellow-400 text-xs">(Bripka)</p>
                        </div>
                    </div>

                    {{-- Foto 3 --}}
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden
                                hover:shadow-lg transition-transform duration-300 ease-in-out
                                transform hover:scale-105 h-full">
                        <div class="flex justify-center items-center h-36 bg-gray-50">
                            <img src="{{ asset('assets/images/Aipda.png') }}" alt="Aipda"
                                class="max-h-32 object-contain">
                        </div>
                        <div class="p-3 text-center bg-gradient-to-r from-slate-700 to-slate-900">
                            <p class="font-semibold text-yellow-400 text-sm tracking-wide">Ajun Inspektur Polisi Dua</p>
                            <p class="text-yellow-400 text-xs">(Aipda)</p>
                        </div>
                    </div>

                    {{-- Foto 4 --}}
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden
                                hover:shadow-lg transition-transform duration-300 ease-in-out
                                transform hover:scale-105 h-full">
                        <div class="flex justify-center items-center h-36 bg-gray-50">
                            <img src="{{ asset('assets/images/Aiptu.png') }}" alt="Aiptu"
                                class="max-h-32 object-contain">
                        </div>
                        <div class="p-3 text-center bg-gradient-to-r from-slate-700 to-slate-900">
                            <p class="font-semibold text-yellow-400 text-sm tracking-wide">Ajun Inspektur Polisi Satu</p>
                            <p class="text-yellow-400 text-xs">(Aiptu)</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- CARD UTAMA HEADER INFORMASI --}}
            <div class="shadow rounded-lg p-6 mt-12 mb-10 relative"
                style="background-color: rgba(255, 255, 255, 0.50); min-height: 64px;">

                {{-- Judul dan Tombol Tambah --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                            bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                            px-6 py-1 rounded-xl shadow-md">
                        <i class="bi bi-calendar-event text-white text-xl md:text-xl"></i>
                        INFORMATION
                    </h2>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-8 top-8">
                                <a href="{{ route('informasi.create') }}"
                                    class="bg-[#800000] hover:bg-[#660000]
                                            text-white px-3 py-2.5 rounded-md text-sm shadow-md transition duration-300 ease-in-out">
                                    <i class="bi bi-plus-circle text-base"></i>
                                    Tambah Informasi
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Flex/Grid Informasi --}}
                <div id="cardGrid"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 items-start invisible">
                    @forelse ($informasi as $data)
                    <div x-data="{ expanded: false }"
                    class="w-full bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col
                    cursor-pointer hover:scale-[1.03] transition duration-300 ease-in-out
                    border border-gray-200 group relative
                    {{ $data->foto ? 'min-h-[520px]' : 'min-h-[340px]' }}">

                            {{-- Gambar --}}
                            @if ($data->foto)
                                <div class="w-full h-52 overflow-hidden">
                                    <img src="{{ asset('storage/' . $data->foto) }}" alt="{{ $data->judul }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif

                            {{-- Konten teks --}}
                            <div class="p-5 flex flex-col flex-grow overflow-hidden">
                                <p class="text-xs text-gray-500 flex items-center gap-1 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0
                                            002-2V7a2 2 0 00-2-2H5a2 2 0
                                            00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>
                                        {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </p>

                                <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">
                                    {{ $data->judul }}
                                </h3>

                                {{-- Deskripsi dengan toggle --}}
                                <div class="text-gray-600 text-sm leading-relaxed text-justify break-words flex-grow overflow-hidden">
                                    <p x-show="!expanded" class="line-clamp-3">
                                        {!! strip_tags($data->deskripsi) !!}
                                    </p>
                                    <p x-show="expanded" x-cloak>
                                        {!! strip_tags($data->deskripsi) !!}
                                    </p>
                                </div>
                            </div>

                            {{-- Tombol Read More --}}
                            <div class="px-5 pb-4 flex items-center justify-between mt-auto">
                                <button @click.stop="expanded = !expanded"
                                        class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded-lg
                                            text-sm font-medium shadow transition duration-300">
                                    <span x-text="expanded ? 'Close' : 'Read More'"></span>
                                </button>

                                {{-- Button Edit Delete --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('informasi.edit', $data->id) }}" @click.stop
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
                                            <button type="button" @click.stop
                                                    class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100
                                                        shadow transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusInformasiModal{{ $data->id }}"
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
                    @empty
                        <p class="text-gray-600 w-full text-center">Belum ada informasi yang ditambahkan.</p>
                    @endforelse
                </div>

            {{-- Modal Konfirmasi Hapus --}}
            @foreach($informasi as $data)
            <div class="modal fade" id="hapusInformasiModal{{ $data->id }}" tabindex="-1"
                aria-labelledby="hapusInformasiLabel{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-2xl shadow-lg border-0">

                        {{-- Header --}}
                        <div class="modal-header bg-red-600 text-white rounded-t-2xl">
                            <h5 class="modal-title d-flex align-items-center gap-2" id="hapusInformasiLabel{{ $data->id }}">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                                Konfirmasi Hapus
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        {{-- Body --}}
                        <div class="modal-body text-center py-4">
                            <i class="bi bi-trash3-fill text-danger fs-1 mb-3"></i>
                            <p class="fw-semibold text-gray-700">
                                Apakah anda yakin ingin menghapus data <br>
                                <span class="text-danger">"{{ $data->judul }}"</span>?
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div class="modal-footer d-flex justify-content-center gap-3 border-0 pb-4">
                            <form action="{{ route('informasi.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">
                                    Hapus
                                </button>
                            </form>
                            <button type="button"
                                    class="btn btn-primary px-4 py-2 rounded-pill shadow-sm"
                                    data-bs-dismiss="modal">
                                    Batal
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

            {{-- Media Sosial dan Kontak --}}
            <div class="mb-6 shadow rounded-lg py-8 px-6 bg-gradient-to-b from-white to-blue-50 border-t-4 border-blue-400">
                {{-- Header --}}
                <div class="flex justify-center items-center mb-6">
                    <h2 class="font-bold text-2xl text-[#2c3e50] flex items-center gap-2 mb-3">
                        SOCIAL MEDIA & CONTACT
                    </h2>
                </div>

                {{-- Body --}}
                <div class="flex justify-center flex-wrap gap-6 mt-4 mb-6">

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/humas_setukpa?igsh=MTE3dWU4emFjYjFtdg=="
                        class="bg-white shadow-md border border-gray-200 rounded-xl w-32 h-32 flex flex-col items-center justify-center
                            hover:shadow-xl hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                        <i class="bi bi-instagram text-3xl text-pink-500 mb-2"></i>
                        <span class="font-medium text-gray-700 text-center">Instagram</span>
                    </a>

                    {{-- YouTube --}}
                    <a href="https://youtube.com/@humassetukpa566?si=b4Ret7QbAoK5vW39"
                        class="bg-white shadow-md border border-gray-200 rounded-xl w-32 h-32 flex flex-col items-center justify-center
                            hover:shadow-xl hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                        <i class="bi bi-youtube text-3xl text-red-600 mb-2"></i>
                        <span class="font-medium text-gray-700 text-center">YouTube</span>
                    </a>

                    {{-- TikTok --}}
                    <a href="https://www.tiktok.com/@humas_setukpa?_t=ZS-8yOduXJ7cs4&_r=1"
                        class="bg-white shadow-md border border-gray-200 rounded-xl w-32 h-32 flex flex-col items-center justify-center
                            hover:shadow-xl hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                        <i class="bi bi-tiktok text-3xl text-black mb-2"></i>
                        <span class="font-medium text-gray-700 text-center">TikTok</span>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/6281212121212" target="_blank"
                        class="bg-white shadow-md border border-gray-200 rounded-xl w-32 h-32 flex flex-col items-center justify-center
                            hover:shadow-xl hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                        <i class="bi bi-whatsapp text-3xl text-green-500 mb-2"></i>
                        <span class="font-medium text-gray-700 text-center">WhatsApp</span>
                    </a>

                    {{-- Telpon --}}
                    <div x-data="{ modalOpen: false }" class="relative">
                        <button @click="modalOpen = true"
                                class="bg-white shadow-md border border-gray-200 rounded-xl w-32 h-32 flex flex-col items-center justify-center
                                    hover:shadow-xl hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                            <i class="bi bi-telephone text-3xl text-green-600 mb-2"></i>
                            <span class="font-medium text-gray-700 text-center">Phone</span>
                        </button>

                        {{-- Modal --}}
                        <div x-show="modalOpen" x-transition
                            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
                            x-cloak>
                            <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                                <h2 class="text-lg font-semibold mb-4">Konfirmasi Panggilan</h2>
                                <p>Apakah Anda ingin menelepon <strong>062266225481</strong>?</p>
                                <div class="mt-6 flex justify-end gap-3">
                                    <a href="tel:062266225481"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                        Panggil
                                    </a>
                                    <button @click="modalOpen = false"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Peta --}}
            <div class="mt-6 mb-10 w-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.305004477184!2d106.90528948715817!3d-6.911367899999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848356fffffff%3A0xf319c6be506068e7!2sEducational%20Establishment%20Officer!5e0!3m2!1sen!2sid!4v1753245232528!5m2!1sen!2sid"
                        width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md">
                </iframe>
            </div>
        </div>
    </div>

    <script>
        // Hilangin flash berantakan pas load grid
        document.addEventListener("DOMContentLoaded", () => {
            let grid = document.getElementById("cardGrid");
            grid.classList.remove("invisible");
            grid.classList.add("visible");
        });
    </script>
</x-app-layout>
