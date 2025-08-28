<x-app-layout>

    @section('title', 'MODUL SIP | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="shadow-lg rounded-2xl p-6 mb-10 bg-white/95 backdrop-blur">

                {{-- BARIS ATAS: KEMBALI + JUDUL + TAMBAH --}}
                <div class="grid grid-cols-3 items-center mb-6">

                    {{-- Tombol Kembali --}}
                    <div class="flex items-center">
                        <a href="{{ route('modul.index') }}"
                           class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-700 to-gray-800 
                                  hover:from-gray-800 hover:to-black text-white text-sm font-medium rounded-lg shadow transition">
                            <i class="bi-chevron-left mr-1"></i> Kembali
                        </a>
                    </div>

                    {{-- Judul --}}
                    <div class="text-center">
                        <h2 class="text-lg md:text-base font-bold text-white
                                inline-flex items-center gap-2
                                bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                                px-6 py-1 rounded-xl shadow-lg">
                            <i class="bi bi-book text-xl"></i>
                            MODUL SIP
                        </h2>
                    </div>

                    {{-- Button Tambah Modul --}}
                    <div class="flex justify-end items-center">
                        @auth
                            @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                <a href="{{ route('modul.create') }}"
                                    class="bg-gradient-to-r from-cyan-500 via-blue-600 to-blue-800
                                        hover:from-cyan-600 hover:via-blue-700 hover:to-blue-900
                                        text-white px-4 py-2 rounded-lg text-sm shadow-lg transition">
                                    <i class="bi bi-plus-circle mr-1"></i> Tambah Modul
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- FILTER --}}
                <form method="GET" action="{{ route('modul.sip') }}" 
                        class="flex flex-wrap items-center gap-3 mb-6">
                    <select name="tahun"
                            class="form-select text-sm rounded-lg w-auto min-w-[100px] max-w-[140px]
                                bg-gray-100 text-gray-800 border border-gray-300 
                                focus:border-blue-500 focus:ring-blue-400">
                        <option value="">Pilih Tahun</option>
                        @foreach ($allTahun as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    <button class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded-lg shadow transition">
                        <i class="bi bi-search mr-1"></i> Search
                    </button>
                </form>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div id="success-alert" 
                        class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg shadow transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            let alertBox = document.getElementById('success-alert');
                            if (alertBox) {
                                alertBox.style.opacity = '0';
                                setTimeout(() => alertBox.remove(), 500);
                            }
                        }, 4000);
                    </script>
                @endif

                {{-- GARIS PEMBATAS --}}
                <div class="border-b border-gray-300 mb-6"></div>

                {{-- ACCORDION PER MAPEL --}}
                <div class="space-y-6">
                    @php
                        $mapels = $moduls->groupBy('mapel');
                        $no = 1;
                    @endphp

                    @forelse ($mapels as $mapel => $list)
                        <details class="group border border-gray-200 rounded-xl shadow-md bg-white transition">
                            <summary class="flex items-center justify-between px-5 py-3 cursor-pointer 
                                            font-semibold text-gray-700 hover:bg-gray-100 rounded-t-xl">
                                <div class="flex items-center gap-3">
                                    <i class="bi bi-journal-text text-blue-600"></i>
                                    <span>{{ str_pad($no++, 2, '0', STR_PAD_LEFT) }}. {{ $mapel ?? 'Tanpa Mapel' }}</span>
                                </div>
                                <i class="bi bi-chevron-right group-open:rotate-90 transition-transform"></i>
                            </summary>

                            {{-- Daftar Modul --}}
                            <div class="space-y-3 p-5 border-t bg-gray-50">
                                @foreach ($list as $mod)
                                    <div class="flex items-center justify-between bg-white shadow hover:shadow-lg 
                                                transition rounded-xl p-4 border border-gray-100">
                                        <div class="flex items-start gap-3">
                                            <a href="{{ asset('storage/' . $mod->file) }}" target="_blank"
                                                class="bg-red-600 text-white px-3 py-1 text-sm rounded-md shadow flex items-center gap-1 hover:bg-red-700 transition">
                                                <i class="bi bi-file-earmark-pdf"></i> PDF
                                            </a>
                                            <div>
                                                <a href="{{ asset('storage/' . $mod->file) }}" target="_blank"
                                                    class="font-semibold text-gray-800 hover:text-blue-600 transition">
                                                    {{ $mod->judul }}
                                                </a>
                                                <p class="text-sm text-gray-600 mt-1">{{ $mod->deskripsi ?? '-' }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Tahun: {{ $mod->tahun ?? '-' }}</p>
                                            </div>
                                        </div>

                                        {{-- Aksi Edit & Hapus --}}
                                        @auth
                                            @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                                <div class="flex justify-end gap-2 mt-2">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('modul.edit', $mod->id) }}" @click.stop
                                                    class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                        </svg>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <button type="button" @click.stop
                                                            class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusModulModal{{ $mod->id }}"
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

    {{-- MODAL HAPUS DI LUAR LOOP ACCORDION --}}
    @foreach ($moduls as $mod)
        <div class="modal fade" id="hapusModulModal{{ $mod->id }}" tabindex="-1" aria-labelledby="hapusLabel{{ $mod->id }}" aria-hidden="true" style="z-index:1050;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header bg-red-600 text-white rounded-t-lg">
                        <h5 class="modal-title" id="hapusLabel{{ $mod->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus modul <b>{{ $mod->judul }}</b>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('modul.destroy', $mod->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </form>
                        <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
