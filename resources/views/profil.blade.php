<x-app-layout>
    @section('title', 'Profil | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- SECTION 1: Sejarah Setukpa --}}
            <div class="mb-10 bg-white shadow-md rounded-xl p-6 flex flex-col md:flex-row items-center md:items-start gap-8">
                
                {{-- Gambar (Tanpa animasi) --}}
                <div class="w-full md:w-1/2 overflow-hidden rounded-lg">
                    <img src="{{ asset('assets/images/setukpa1.jpg') }}"
                        alt="Profil Setukpa"
                        class="rounded-lg w-full object-cover h-[320px]">
                </div>

                {{-- Konten Teks --}}
                <div class="w-full md:w-1/2">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="bi bi-mortarboard-fill text-[#2c3e50] text-2xl"></i>
                        <h2 class="text-2xl font-bold text-[#2c3e50]">Profil Setukpa Lemdiklat Polri</h2>
                    </div>
                    <p class="text-gray-700 mb-5 text-base leading-relaxed">
                        Setukpa Lemdiklat Polri atau Sekolah Pembentukan Perwira Polri adalah sekolah kedinasan Kepolisian Negara Republik Indonesia yang bertugas untuk menyelenggarakan fungsi pembentukan perwira Polri yang bersumber dari anggota Polri. Setukpa Polri sebelumnya bernama Secapa Polri (Sekolah Calon Perwira Polri).
                    </p>
                    <a href="#"
                    class="inline-block bg-[#2c3e50] hover:bg-[#1a252f] text-white px-5 py-2 rounded-md text-sm font-medium shadow-md transition duration-300">
                        Baca Lebih Lanjut
                    </a>
                </div>
            </div>

            {{-- SECTION 2: Profil Setukpa --}}
            <div class="mb-10 bg-white shadow rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start gap-6">
                {{-- Gambar --}}
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('assets/images/setukpa1.jpg') }}" alt="Profil Setukpa" class="rounded-lg w-full object-cover h-[320px]">
                </div>

                {{-- Konten Teks --}}
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-extrabold text-[#2c3e50] mb-3 border-b-4 border-[#2c3e50] inline-block pb-1">
                        Profil Setukpa Lemdiklat Polri
                    </h2>
                    <p class="text-gray-700 mb-4 text-[15px] leading-relaxed tracking-wide">
                        <span class="font-semibold text-[#2c3e50]">Setukpa Lemdiklat Polri</span> atau <em>Sekolah Pembentukan Perwira Polri</em> adalah sekolah kedinasan Kepolisian Negara Republik Indonesia yang bertugas untuk menyelenggarakan fungsi pembentukan perwira Polri yang bersumber dari anggota Polri.
                        <br><br>
                        Sebelumnya, Setukpa dikenal dengan nama <span class="font-medium italic text-[#2c3e50]">Secapa Polri</span> (Sekolah Calon Perwira Polri).
                    </p>
                </div>
            </div>

            {{-- SECTION 3: Visi dan Misi --}}
            <div class="mb-12 bg-white shadow rounded-lg px-6 py-10">
                {{-- Visi --}}
                <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-[#2c3e50] mb-4">Visi Setukpa Lemdiklat Polri</h3>
                    <p class="text-gray-700 text-base md:text-lg leading-relaxed max-w-3xl mx-auto">
                        Lembaga pendidikan yang mampu mewujudkan insan Polri yang memahami jati dirinya sebagai Inspektur Polri, memiliki integritas moral tinggi, menguasai ilmu pengetahuan dan teknologi kepolisian secara profesional, serta mengaplikasikannya dengan didukung oleh kesiapan jasmani.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="text-center mb-8">
                    <h3 class="text-2xl md:text-3xl font-bold text-[#2c3e50] mb-6">Misi Setukpa Lemdiklat Polri</h3>
                    <div class="max-w-3xl mx-auto text-left space-y-6">
                        @foreach ([
                            'Mendidik dan melatih Brigadir Polri terpilih menjadi Inspektur Pertama Polri melalui pendidikan pembentukan perwira.',
                            'Membekali ilmu pengetahuan dan teknologi kepolisian, meningkatkan kualitas peserta didik melalui penyelenggaraan pendidikan untuk mengoptimalkan kemampuannya menjadi Inspektur Pertama Polri dalam mengemban tugas Kamtibmas selaku pelindung, pengayom, dan pelayan masyarakat.',
                            'Membangun moral, kepribadian, dan perubahan karakter Brigadir menjadi Inspektur Pertama Polri yang berlandaskan kepada moral agama, penguasaan ilmu pengetahuan dan teknologi kepolisian, didukung oleh kesiapan jasmani, serta mengerti dan memperhatikan aspirasi atau kebutuhan masyarakat.'
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
            <div class="pt-10 mt-10 border-t border-gray-200"></div>

            {{-- SECTION 4: Struktur Organisasi --}}
            <div class="mb-12 shadow rounded-lg p-6 text-center" style="background-color: rgba(255, 255, 255, 0.40);">
                {{-- Judul dan Tombol Tambah --}}
                <div class="relative pb-6 text-center">
                {{-- Judul + Ikon --}}
                <div class="inline-flex items-center space-x-3">
                    <i class="bi bi-people-fill text-2xl text-[#2c3e50]"></i>
                    <h2 class="text-2xl font-bold text-[#2c3e50]">Struktur Organisasi</h2>
                </div>

                {{-- Tombol Tambah Data --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="absolute right-0 top-1">
                            <a href="{{ route('profil.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow transition duration-300">
                            <i class="bi bi-plus-circle text-base "></i>
                                Tambah Personel
                            </a>
                        </div>
                    @endif
                @endauth
            </div>


                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Grid Kasetukpa --}}
                @if ($kasetukpa)
    <div class="flex justify-center mb-8 relative">
    <div class="bg-white shadow-md rounded-lg overflow-hidden w-56 flex flex-col relative transition transform duration-300 ease-in-out hover:scale-105 group pb-4">
            <div class="aspect-[3/4] overflow-hidden bg-gray-100 max-h-60">
                <img src="{{ asset('storage/' . $kasetukpa->foto) }}" alt="Foto Kasetukpa" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-4 text-center">
                <h3 class="text-sm font-bold text-gray-800 pb-2">{{ $kasetukpa->nama }}</h3>
                <p class="text-sm text-gray-500">{{ $kasetukpa->jabatan }}</p>
            </div>

            {{-- Tombol Edit & Hapus --}}
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="flex justify-end pr-4 gap-3">
                        <a href="{{ route('profil.edit', $kasetukpa->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>

                        <button type="button" class="text-red-600 hover:text-red-800 transition" data-bs-toggle="modal" data-bs-target="#hapusProfilModal{{ $kasetukpa->id }}" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                            </svg>
                        </button>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Modal Hapus Kasetukpa --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="modal fade" id="hapusProfilModal{{ $kasetukpa->id }}" tabindex="-1" aria-labelledby="hapusProfilLabel{{ $kasetukpa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="hapusProfilLabel{{ $kasetukpa->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <strong>{{ $kasetukpa->nama }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('profil.destroy', $kasetukpa->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endif


                {{-- Grid Wakasetukpa --}}
                @if ($wakasetukpa)
    <div class="flex justify-center mb-8 relative">
    <div class="bg-white shadow-md rounded-lg overflow-hidden w-56 flex flex-col relative transition transform duration-300 ease-in-out hover:scale-105 group pb-6">
            <div class="aspect-[3/4] overflow-hidden bg-gray-100 max-h-60">
                <img src="{{ asset('storage/' . $wakasetukpa->foto) }}" alt="Foto Wakasetukpa" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-4 text-center">
                <h3 class="text-sm font-bold text-gray-800 pb-2">{{ $wakasetukpa->nama }}</h3>
                <p class="text-sm text-gray-500">{{ $wakasetukpa->jabatan }}</p>
            </div>

            {{-- Tombol Edit & Hapus --}}
            @auth
                @if(Auth::user()->role === 'admin')
                <div class="flex justify-end pr-4  gap-3">
                        <a href="{{ route('profil.edit', $wakasetukpa->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>

                        <button type="button" class="text-red-600 hover:text-red-800 transition" data-bs-toggle="modal" data-bs-target="#hapusProfilModal{{ $wakasetukpa->id }}" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                            </svg>
                        </button>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Modal Hapus Wakasetukpa --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="modal fade" id="hapusProfilModal{{ $wakasetukpa->id }}" tabindex="-1" aria-labelledby="hapusProfilLabel{{ $wakasetukpa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="hapusProfilLabel{{ $wakasetukpa->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <strong>{{ $wakasetukpa->nama }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('profil.destroy', $wakasetukpa->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endif


                {{-- Grid Pimpinan Lain --}}
                @if ($pimpinanLain->count())
                <div class="flex overflow-x-auto gap-4 pb-4">

                        @foreach ($pimpinanLain as $profil)
                        <div class="w-56 bg-white shadow-md rounded-lg overflow-hidden flex-shrink-0 flex flex-col relative transition transform duration-300 ease-in-out hover:scale-105 group pb-4">

                                <div class="w-full aspect-[3/4] overflow-hidden bg-gray-100 max-h-60">
                                    @if ($profil->foto)
                                        <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Pimpinan" class="w-full h-full object-cover object-top">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-600 bg-gray-200">
                                            Tidak ada foto
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-sm font-bold text-gray-800 pb-2">{{ $profil->nama }}</h3>
                                    <p class="text-sm text-gray-500">{{ $profil->jabatan }}</p>
                                </div>

                                {{-- Tombol Edit & Hapus (admin) --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex justify-end pr-4 gap-3">
                                            <a href="{{ route('profil.edit', $profil->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            <button type="button" class="text-red-600 hover:text-red-800 transition" data-bs-toggle="modal" data-bs-target="#hapusProfilModal{{ $profil->id }}" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
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

    {{-- Modal Hapus --}}
    @foreach($pimpinanLain as $profil)
        <div class="modal fade" id="hapusProfilModal{{ $profil->id }}" tabindex="-1" aria-labelledby="hapusProfilLabel{{ $profil->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="hapusProfilLabel{{ $profil->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus <strong>{{ $profil->nama }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('profil.destroy', $profil->id) }}" method="POST">
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
</x-app-layout>
