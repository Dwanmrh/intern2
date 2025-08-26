<x-app-layout>
    @section('title', 'PROFIL | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- SECTION 1: Sejarah Setukpa --}}
            <div class="mb-10 bg-white shadow-md rounded-xl p-6 flex flex-col md:flex-row items-center md:items-start gap-8">
                {{-- Gambar (Tanpa animasi) --}}
                <div class="w-full md:w-1/2 overflow-hidden rounded-lg">
                    <img src="{{ asset('assets/images/gerbang.png') }}" alt="Profil Setukpa" class="rounded-lg w-full object-cover h-[460px]">
                </div>

                {{-- Konten Sejarah --}}
                <div class="w-full md:w-1/2">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="bi bi-mortarboard-fill text-[#2c3e50] text-2xl"></i>
                        <h2 class="text-2xl font-bold text-[#2c3e50]">
                            Sejarah Singkat Pendidikan Kepolisian di Sukabumi
                        </h2>
                    </div>

                    {{-- Konten dengan scroll internal --}}
                    <div class="text-gray-700 text-base leading-relaxed text-justify prose max-w-none border rounded-lg p-4 shadow-inner overflow-y-auto" style="max-height: 350px; scrollbar-width: thin; scrollbar-color: #2c3e50 #f1f1f1;">
                        <p><strong>MASA PENJAJAHAN BELANDA</strong></p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>1905</strong><br>
                                Terbentuk kepolisian untuk menghasilkan Polisi Pemerintah dan Polisi Desa, namun anggotanya tidak berpendidikan dan belum ada sistem kerja.
                            </li>
                            <li><strong>1911</strong><br>
                                Pemerintah Hindia Belanda membuka kursus pendidikan Agen Polisi di Batavia, Semarang, dan Surabaya.
                            </li>
                            <li><strong>1912</strong><br>
                                Dipilih Sukabumi sebagai lokasi <em>Centraal Depot Gewapende Politie</em> (Depo Polisi bersenjata).
                            </li>
                            <li><strong>1913</strong><br>
                                Dibangun Depo Polisi bersenjata lengkap dengan rumah sakit dan sekolah kader, khusus mendidik Agen Polisi untuk ditempatkan di luar Jawa.
                            </li>
                            <li><strong>1914–1917</strong><br>
                                Kursus Polisi dipusatkan di Batavia. Depo Sukabumi diperbaiki menjadi bangunan permanen dengan fasilitas listrik, rumah sakit, dan lapangan tembak.
                            </li>
                            <li><strong>1920</strong><br>
                                Kursus Polisi dipindahkan ke Panaragan, Bogor.
                            </li>
                            <li><strong>1925</strong><br>
                                Sekolah Polisi dipindahkan dari Bogor ke Sukabumi (Politie School), menjadikan Sukabumi pusat pendidikan kepolisian Hindia Belanda.
                            </li>
                        </ul>

                        <p class="mt-4"><strong>MASA PENJAJAHAN JEPANG</strong></p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>1942–1944</strong><br>
                                Politie School dikuasai Jepang dan diubah menjadi <em>Jawakaisatsu</em>, mendidik kader Polisi Tinggi dan Polisi Rendah. Lulusannya termasuk Kapolri ke-3 Mayjen Pol. R. Sutjipto Danukusumo dan Kapolri ke-5 Jenderal Polisi Hoegeng.
                            </li>
                            <li><strong>1 Oktober 1945</strong><br>
                                Sekolah Polisi berhasil diambil alih dari Jepang oleh Polisi Indonesia, pendidikan dilanjutkan dengan nama Sekolah Polisi Negara (SPN).
                            </li>
                        </ul>

                        <p class="mt-4"><strong>MASA AWAL KEMERDEKAAN</strong></p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>1945 (Desember)</strong><br>
                                Polisi dan siswa turut bertempur dalam pertempuran Bojongkokosan melawan Sekutu/NICA.
                            </li>
                            <li><strong>1946</strong><br>
                                Karena situasi perang, pendidikan dipindahkan ke Mertoyudan (perwira) dan Gunung Buleud (tamtama).
                            </li>
                            <li><strong>1949</strong><br>
                                Setelah pengakuan kedaulatan, dibentuk Sekolah Polisi Indonesia (SPI).
                            </li>
                            <li><strong>1950</strong><br>
                                SPI ditutup, pendidikan kembali dipusatkan di Sukabumi dengan nama SPN Sukabumi. Di sini pula dididik Polwan pertama Indonesia (1951).
                            </li>
                            <li><strong>1952–1960</strong><br>
                                SPN mendidik Agen, Brigadir, hingga Inspektur Polisi.
                            </li>
                            <li><strong>1960</strong><br>
                                SPN berubah menjadi Sekolah Angkatan Kepolisian Republik Indonesia (SAKRI).
                            </li>
                            <li><strong>1965</strong><br>
                                SAKRI berubah menjadi Akademi Angkatan Kepolisian (AAK).
                            </li>
                        </ul>

                        <p class="mt-4"><strong>MASA SESUDAHNYA</strong></p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>1979</strong><br>
                                AKABRI bagian Kepolisian di Sukabumi bertukar tempat dengan Secapa Polri dari Candi, Semarang. Sejak itu Sukabumi menjadi pusat Secapa Polri.
                            </li>
                            <li><strong>1980–2002</strong><br>
                                Pendidikan dilanjutkan sebagai Sekolah Pembentukan Perwira (Setukpa), mendidik SIP Alih Golongan, Dikbangspes, Polsus, Satpam, PPNS, dan lainnya.
                            </li>
                            <li><strong>2003</strong><br>
                                Secapa Polri resmi berubah menjadi Setukpa Lemdiklat Polri berdasarkan Skep Kapolri No. Pol: Skep/95/XII/2003.
                            </li>
                            <li><strong>2022</strong><br>
                                Kota Sukabumi ditetapkan sebagai "Kota Polisi" melalui Keputusan Wali Kota Sukabumi No. 188.45/115-Huk/2022.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: Profil Setukpa --}}
            <div class="mb-10 bg-white shadow rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start gap-6">
                {{-- Video --}}
                <div class="w-full md:w-1/2">
                    <div class="rounded-lg overflow-hidden w-full h-[320px]">
                        <iframe src="https://www.youtube.com/embed/OKcZ_ioT3xs?autoplay=1&mute=1" width="100%" height="100%" allow="autoplay; encrypted-media" class="rounded-lg"></iframe>
                    </div>
                </div>

                {{-- Konten Teks --}}
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-extrabold text-[#2c3e50] mb-3 border-b-4 border-[#2c3e50] inline-block pb-1">
                        Profil Setukpa Lemdiklat Polri
                    </h2>
                    <p class="text-gray-700 mb-4 text-[15px] leading-relaxed tracking-wide text-justify">
                        <span class="font-semibold text-[#2c3e50]">Setukpa Lemdiklat Polri</span> atau
                        <em>Sekolah Pembentukan Perwira Polri</em> adalah sekolah kedinasan Kepolisian Negara Republik Indonesia
                        yang bertugas untuk menyelenggarakan fungsi pembentukan perwira Polri yang bersumber dari anggota Polri.
                        <br><br>
                        Setukpa Polri sebelumnya bernama
                        <span class="font-medium italic text-[#2c3e50]">Secapa Polri</span> (Sekolah Calon Perwira Polri).
                        Setukpa Polri terletak di Kota Sukabumi, Jawa Barat serta dikepalai oleh Kasetukpa Polri
                        yang bertanggungjawab kepada Kalemdiklat Polri.
                        Kasetukpa Polri saat ini adalah Brigadir Jenderal Polisi. Dirin, S.I.K., M.H.
                    </p>
                </div>
            </div>

            {{-- SECTION 3: Visi dan Misi --}}
            <div class="mb-12 bg-white shadow rounded-lg px-6 py-10">
                {{-- Visi --}}
                <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-[#2c3e50] mb-4">VISI SETUKPA LEMDIKLAT POLRI</h3>
                    <p class="text-gray-700 text-base md:text-lg leading-relaxed max-w-3xl mx-auto">
                        Mewujudkan Lulusan Perwira Polri Yang Unggul, Berintegritas, Profesional Dan Modern
                    </p>
                </div>

                {{-- Misi --}}
                <div class="text-center mb-8">
                    <h3 class="text-2xl md:text-3xl font-bold text-[#2c3e50] mb-6">MISI SETUKPA LEMDIKLAT POLRI</h3>
                    <div class="max-w-3xl mx-auto text-left space-y-6">
                        @foreach ([
                            'Membangun moral kepribadian dan perubahan karakter peserta didik, yang berlandaskan agama, penguasaan ilmu pengetahuan dan teknologi kepolisian serta didukung oleh kesiapan jasmani.',
                            'Mendidik dan melatih bintara polri terpilih menjadi inspektur polisi dua yang transformatif, inovatif dan modern.',
                            'Mengembangkan 8 (delapan) standar pendidikan yang modern.'
                        ] as $i => $misi)
                            <div class="flex items-start gap-3">
                                <div class="text-blue-700 font-semibold">{{ $i + 1 }}.</div>
                                <div class="border-l-4 border-blue-600 pl-4 text-gray-700 text-base leading-relaxed">
                                    {{ $misi }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- PEMBATAS --}}
            <div class="pt-1 mt-1 border-t border-gray-200"></div>

            {{-- SECTION 4: Struktur Organisasi --}}
            <div class="mb-12 shadow rounded-lg p-8 text-center bg-gradient-to-b from-white to-yellow-50
                        border-t-4 border-yellow-400">
                {{-- Judul --}}
                <div class="relative mb-8">
                    <h2 class="inline-flex items-center gap-2 text-lg md:text-xl lg:text-xl font-bold
                            text-black bg-gradient-to-r from-yellow-400 to-yellow-500
                            px-4 py-1 rounded-xl shadow-md">
                        <i class="bi bi-people-fill text-xl text-black md:text-lg"></i>
                        STRUKTUR ORGANISASI
                    </h2>

                    {{-- Tombol Tambah Data --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-0 top-1/2 -translate-y-1/2">
                                <a href="{{ route('profil.create') }}" class="bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700 hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800 text-white px-4 py-2 rounded-md text-sm shadow-md">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Personel
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
                                alertBox.style.opacity = '0';
                                setTimeout(() => alertBox.remove(), 500);
                            }
                        }, 5000);
                    </script>
                @endif

                {{-- Grid Kasetukpa --}}
                @if ($kasetukpa)
                    <div class="flex justify-center mt-6 mb-8 relative">
                        <div class="bg-gradient-to-b from-white to-gray-50 shadow-2xl rounded-2xl overflow-hidden w-56 flex flex-col relative
                                    transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-[0_8px_30px_rgba(0,0,0,0.3)]
                                    border border-gray-200 hover:border-yellow-500">

                            <!-- Foto -->
                            <div class="aspect-[3/4] overflow-hidden bg-gray-100 relative">
                                <img src="{{ asset('storage/' . $kasetukpa->foto) }}"
                                    alt="Foto Kasetukpa"
                                    class="w-full h-full object-cover object-top rounded-t-2xl border-b border-gray-200">
                            </div>

                            <!-- Nama & Jabatan -->
                            <div class="p-2 text-center">
                                <h3 class="text-base font-semibold text-yellow-600 mt-1 uppercase tracking-wider">{{ $kasetukpa->jabatan }}</h3>
                                <p class="text-sm text-gray-900 tracking-wide mt-1">{{ $kasetukpa->nama }}</p>
                            </div>

                            {{-- Tombol Edit & Hapus --}}
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex justify-center items-center gap-3 mt-auto py-3">
                                        <a href="{{ route('profil.edit', $kasetukpa->id) }}"
                                        class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition"
                                        title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002
                                                        2h12a2 2 0 002-2v-5M18.5 2.5a2.121
                                                        2.121 0 113 3L12 15l-4 1 1-4
                                                        9.5-9.5z"/>
                                            </svg>
                                        </a>
                                        <button type="button"
                                                class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusProfilModal{{ $kasetukpa->id }}"
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
                                @endif
                            @endauth
                        </div>
                    </div>
                @endif

                {{-- Grid Wakasetukpa --}}
                @if ($wakasetukpa)
                    <div class="flex justify-center mt-6 mb-8 relative">
                        <div class="bg-gradient-to-b from-white to-gray-50 shadow-2xl rounded-2xl overflow-hidden w-56 flex flex-col relative
                                    transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-[0_8px_30px_rgba(0,0,0,0.3)]
                                    border border-gray-200 hover:border-yellow-500">

                            <!-- Foto -->
                            <div class="aspect-[3/4] overflow-hidden bg-gray-100 relative">
                                <img src="{{ asset('storage/' . $wakasetukpa->foto) }}"
                                    alt="Foto Wakasetukpa"
                                    class="w-full h-full object-cover object-top rounded-t-2xl border-b border-gray-200">
                            </div>

                            <!-- Nama & Jabatan -->
                            <div class="p-2 text-center">
                                <h3 class="text-base font-semibold text-yellow-600 mt-1 uppercase tracking-wider">{{ $wakasetukpa->jabatan }}</h3>
                                <p class="text-sm text-gray-900 tracking-wide mt-1">{{ $wakasetukpa->nama }}</p>
                            </div>

                            {{-- Tombol Edit & Hapus --}}
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex justify-center items-center gap-3 mt-auto py-3">
                                        <a href="{{ route('profil.edit', $wakasetukpa->id) }}"
                                        class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition"
                                        title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002
                                                        2h12a2 2 0 002-2v-5M18.5 2.5a2.121
                                                        2.121 0 113 3L12 15l-4 1 1-4
                                                        9.5-9.5z"/>
                                            </svg>
                                        </a>
                                        <button type="button"
                                                class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusProfilModal{{ $wakasetukpa->id }}"
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
                                @endif
                            @endauth
                        </div>
                    </div>
                @endif

                {{-- Grid Pimpinan Lain --}}
                @if ($pimpinanLain->count())
                    <div class="flex overflow-x-auto gap-4 pb-4 py-4">
                        @foreach ($pimpinanLain as $profil)
                            <div class="bg-gradient-to-b from-white to-gray-50 shadow-2xl rounded-2xl overflow-hidden w-56 flex flex-col relative
                                        transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-[0_8px_30px_rgba(0,0,0,0.3)]
                                        border border-gray-200 hover:border-yellow-500 flex-shrink-0">

                                <!-- Foto -->
                                <div class="aspect-[3/4] overflow-hidden bg-gray-100 relative">
                                    @if ($profil->foto)
                                        <img src="{{ asset('storage/' . $profil->foto) }}"
                                            alt="Foto Pimpinan"
                                            class="w-full h-full object-cover object-top rounded-t-2xl border-b border-gray-200">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-600 bg-gray-200">
                                            Tidak ada foto
                                        </div>
                                    @endif
                                </div>

                                <!-- Nama & Jabatan -->
                                <div class="p-2 text-center">
                                    <h3 class="text-base font-semibold text-yellow-600 mt-1 uppercase tracking-wider">{{ $profil->jabatan }}</h3>
                                    <p class="text-sm text-gray-900 tracking-wide mt-1">{{ $profil->nama }}</p>
                                </div>

                                {{-- Tombol Edit & Hapus --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex justify-center items-center gap-3 mt-auto py-3">
                                            <a href="{{ route('profil.edit', $profil->id) }}"
                                            class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition"
                                            title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002
                                                            2h12a2 2 0 002-2v-5M18.5 2.5a2.121
                                                            2.121 0 113 3L12 15l-4 1 1-4
                                                            9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <button type="button"
                                                    class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusProfilModal{{ $profil->id }}"
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
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 col-span-4 text-center">Belum ada Data lain.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>