<x-app-layout>
    @section('title', 'Profil | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- SECTION 1: Profil Setukpa --}}
            <div class="mb-10 bg-white shadow rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('assets/images/setukpa1.jpg') }}" alt="Profil Setukpa" class="rounded-lg w-full object-cover h-[320px]">
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-bold text-[#2c3e50] mb-3">Profil Setukpa Lemdiklat Polri</h2>
                    <p class="text-gray-700 mb-4 text-base leading-relaxed">
                        Setukpa Lemdiklat Polri atau Sekolah Pembentukan Perwira Polri adalah sekolah kedinasan Kepolisian Negara Republik Indonesia yang bertugas untuk menyelenggarakan fungsi pembentukan perwira Polri yang bersumber dari anggota Polri. Setukpa Polri sebelumnya bernama Secapa Polri (Sekolah Calon Perwira Polri).
                    </p>
                    <a href="#" class="inline-block bg-[#2c3e50] text-white px-5 py-2 rounded-md hover:bg-[#1a252f] text-sm transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            {{-- SECTION 2: Visi dan Misi --}}
            <div class="mb-12 bg-white shadow rounded-lg p-6 text-center">
                <h3 class="text-2xl font-bold text-[#2c3e50] mb-4">Visi Setukpa Lemdiklat Polri</h3>
                <p class="text-gray-700 mb-12 text-base leading-relaxed mx-auto max-w-xl">
                    Lembaga pendidikan yang mampu mewujudkan insan Polri yang memahami jati dirinya sebagai Inspektur Polri, memiliki integritas moral tinggi, menguasai ilmu pengetahuan dan teknologi kepolisian secara profesional, serta mengaplikasikannya dengan didukung oleh kesiapan jasmani.
                </p>

                <h3 class="text-2xl font-bold text-[#2c3e50] mb-4">Misi Setukpa Lemdiklat Polri</h3>
                <div class="mx-auto max-w-xl text-left space-y-3 mb-16">
                    @foreach ([
                        'Mendidik dan melatih Brigadir Polri terpilih menjadi Inspektur Pertama Polri melalui pendidikan pembentukan perwira.',
                        'Membekali ilmu pengetahuan dan teknologi kepolisian, meningkatkan kualitas peserta didik melalui penyelenggaraan pendidikan untuk mengoptimalkan kemampuannya menjadi Inspektur Pertama Polri dalam mengemban tugas Kamtibmas selaku pelindung, pengayom, dan pelayan masyarakat.',
                        'Membangun moral, kepribadian, dan perubahan karakter Brigadir menjadi Inspektur Pertama Polri yang berlandaskan kepada moral agama, penguasaan ilmu pengetahuan dan teknologi kepolisian, didukung oleh kesiapan jasmani, serta mengerti dan memperhatikan aspirasi atau kebutuhan masyarakat.'
                    ] as $i => $misi)
                        <div class="flex items-start gap-2">
                            <span class="w-6 text-right">{{ $i + 1 }}.</span>
                            <p class="text-gray-700 text-base leading-relaxed">{{ $misi }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- PEMBATAS --}}
            <div class="pt-10 mt-10 border-t border-gray-200"></div>

            {{-- SECTION 3: Struktur Organisasi --}}
            <div class="mb-12 bg-white shadow rounded-lg p-6 text-center">
                {{-- Judul dan Tombol Tambah --}}
                <div class="relative flex items-center justify-center">
                    <h2 class="text-2xl font-bold text-[#2c3e50]">Struktur Organisasi</h2>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="absolute right-0 top-1">
                                <a href="{{ route('profil.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                    + Tambah Pimpinan
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
                    <div class="flex justify-center mb-8">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-72">
                            <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $kasetukpa->foto) }}" alt="Foto Kasetukpa" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-bold text-gray-800">{{ $kasetukpa->nama }}</h3>
                                <p class="text-sm text-gray-500">{{ $kasetukpa->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Grid Wakasetukpa --}}
                @if ($wakasetukpa)
                    <div class="flex justify-center mb-8">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-72">
                            <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $wakasetukpa->foto) }}" alt="Foto Wakasetukpa" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-bold text-gray-800">{{ $wakasetukpa->nama }}</h3>
                                <p class="text-sm text-gray-500">{{ $wakasetukpa->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Grid Pimpinan Lain --}}
                @if ($pimpinanLain->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($pimpinanLain as $profil)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col relative transition transform duration-300 ease-in-out hover:scale-105 group">
                                <div class="w-full aspect-[3/4] overflow-hidden bg-gray-100">
                                    @if ($profil->foto)
                                        <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Pimpinan" class="w-full h-full object-cover object-top">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-600 bg-gray-200">
                                            Tidak ada foto
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $profil->nama }}</h3>
                                    <p class="text-sm text-gray-500">{{ $profil->jabatan }}</p>
                                </div>

                                {{-- Tombol Edit & Hapus (admin) --}}
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="absolute bottom-3 right-3 flex gap-3">
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
                    <p class="text-gray-600 col-span-4 text-center">Belum ada pimpinan lain.</p>
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
