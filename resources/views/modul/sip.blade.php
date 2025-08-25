<x-app-layout>

    @section('title', 'MODUL SIP | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="shadow rounded-lg p-6 mb-10"
                 style="background-color: rgba(255, 255, 255, 0.95);">

                {{-- BARIS ATAS: KEMBALI + JUDUL + TAMBAH --}}
                <div class="grid grid-cols-3 items-center mb-6">

                    {{-- Tombol Kembali (kiri) --}}
                    <div>
                        <a href="{{ route('modul.index') }}"
                            class="inline-flex items-center px-3 py-1.5 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium rounded transition duration-200">
                            ← Kembali
                        </a>
                    </div>

                    {{-- JUDUL (tengah, selalu center) --}}
                    <div class="text-center">
                        <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-[#2c3e50] inline-flex items-center gap-2">
                            <i class="bi bi-book"></i>
                            MODUL SIP
                        </h2>
                    </div>

                    {{-- Button Tambah Modul (kanan, hanya admin dan personel) --}}
                    <div class="text-right">
                        @auth
                            @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                <a href="{{ route('modul.create') }}"
                                    class="bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-700 hover:from-cyan-500 hover:via-blue-600 hover:to-blue-800 text-white px-4 py-2 rounded-md text-sm shadow-md transition duration-300 ease-in-out">
                                    <i class="bi bi-plus-circle text-base text-white"></i>
                                    Tambah Modul
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- BARIS FILTER (baru) --}}
                <form method="GET" action="{{ route('modul.sip') }}" class="flex flex-wrap items-center gap-3 mb-6">
                    <select name="tahun" class="form-select text-sm rounded-md w-36">
                        <option value="">Pilih Tahun</option>
                        @foreach ($allTahun as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                        Search
                    </button>
                </form>

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

                {{-- GARIS PEMBATAS --}}
                <div class="border-b mb-6"></div>

                {{-- ACCORDION PER MAPEL --}}
                <div class="space-y-4">
                    @php
                        $mapels = $moduls->groupBy('mapel');
                        $no = 1;
                    @endphp

                    @forelse ($mapels as $mapel => $list)
                        <details class="group">
                            <summary class="flex items-center gap-2 cursor-pointer font-semibold text-[#2c3e50]">
                                <i class="bi bi-caret-right-fill group-open:rotate-90 transition-transform"></i>
                                {{ str_pad($no++, 2, '0', STR_PAD_LEFT) }}. {{ $mapel ?? 'Tanpa Mapel' }}
                            </summary>
                            <div class="mt-3 space-y-2 ml-6">
                                @foreach ($list as $modul)
                                    <div class="flex items-center justify-between bg-gray-100 hover:bg-gray-200 p-3 rounded-md">
                                        <div class="flex items-start gap-3">
                                            <div class="bg-blue-600 text-white px-2 py-1 rounded text-xs font-bold">PDF</div>
                                            <div>
                                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="font-semibold text-[#2c3e50] hover:underline">
                                                    {{ $modul->judul }}
                                                </a>
                                                <p class="text-sm text-gray-600">{{ $modul->deskripsi ?? '-' }}</p>
                                                <p class="text-xs text-gray-500">Tahun: {{ $modul->tahun ?? '-' }} | Periode: {{ $modul->periode ?? '-' }}</p>
                                            </div>
                                        </div>

                                        {{-- Aksi Edit & Hapus --}}
                                        @auth
                                            @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                                <div class="flex justify-end gap-4 mt-2">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('modul.edit', $modul->id) }}" @click.stop
                                                        class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                        </svg>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <button type="button" @click.stop
                                                            class="text-red-600 hover:text-red-800 transition"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusModulModal{{ $modul->id }}"
                                                            title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-4v4"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                {{-- Modal Hapus --}}
                                                <div class="modal fade" id="hapusModulModal{{ $modul->id }}" tabindex="-1" aria-labelledby="hapusLabel{{ $modul->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content rounded-lg shadow-lg">
                                                            <div class="modal-header bg-red-600 text-white rounded-t-lg">
                                                                <h5 class="modal-title" id="hapusLabel{{ $modul->id }}">Konfirmasi Hapus</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Yakin ingin menghapus modul <b>{{ $modul->judul }}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('modul.destroy', $modul->id) }}" method="POST">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <p class="text-gray-500 text-center">Belum ada modul tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
