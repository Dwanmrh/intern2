<x-app-layout>

    @section('title', 'MODUL SIP | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="shadow-lg rounded-2xl p-6 mb-10 bg-white/95 backdrop-blur">

                {{-- BARIS ATAS: KEMBALI + JUDUL --}}
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
                        <h2 class="text-lg md:text-lg font-bold text-white
                                inline-flex items-center gap-2
                                bg-gradient-to-r from-[#1E293B] to-[#334155]
                                px-6 py-1 rounded-xl shadow-lg">
                            <i class="bi bi-book text-xl"></i>
                            MODUL SIP
                        </h2>
                    </div>

                    {{-- Kanan dikosongkan --}}
                    <div class="flex justify-end items-center"></div>
                </div>

                {{-- FILTER --}}
                <form method="GET" action="{{ route('modul.sip') }}"
                        class="flex flex-wrap items-center gap-3 mb-6">
                    <select name="tahun"
                            class="form-select text-sm rounded-lg w-auto min-w-[100px] max-w-[140px]
                                bg-gray-100 text-gray-800 border border-gray-100
                                focus:border-blue-500 focus:ring-blue-400">
                        <option value="">Pilih Tahun</option>
                        @foreach ($allTahun as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
                        <i class="bi bi-search mr-1"></i> Search
                    </button>
                </form>

                {{-- GARIS PEMBATAS --}}
                <div class="border-b border-gray-300 mb-6"></div>

                {{-- ACCORDION PER MAPEL --}}
                <div class="space-y-6">
                    @php
                        $orderMapel = config('mapel.SIP');
                        $moduls = collect($moduls);
                        $mapels = $moduls->groupBy('mapel');

                        $sortedMapels = collect($orderMapel)
                            ->filter(fn($mapel) => $mapels->has($mapel))
                            ->mapWithKeys(fn($mapel) => [$mapel => $mapels[$mapel]]);

                        $others = $mapels->except($orderMapel);
                        $sortedMapels = $sortedMapels->merge($others);

                        $no = 1;
                    @endphp

                    @forelse ($sortedMapels as $mapel => $list)
                        <details class="group border border-[#1E293B] rounded-xl shadow-md bg-[#1E293B]/90 transition overflow-hidden">
                            <summary class="flex items-center justify-between px-5 py-3 cursor-pointer
                                            font-semibold text-white hover:bg-[#42556e] rounded-t-xl">
                                <div class="flex items-center gap-3">
                                    <i class="bi bi-journal-text text-yellow-400"></i>
                                    <span>{{ str_pad($no++, 2, '0', STR_PAD_LEFT) }}. {{ $mapel ?? 'Tanpa Mapel' }}</span>
                                </div>
                                <i class="bi bi-chevron-right group-open:rotate-90 transition-transform"></i>
                            </summary>

                            {{-- Daftar Modul --}}
                            <div class="space-y-3 p-5 border-t border-gray-600 bg-[#334155]/70">
                                @foreach ($list as $mod)
                                    <div class="flex items-center justify-between bg-gray-200 shadow hover:shadow-lg
                                                transition rounded-xl p-4">
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
                                            @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
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

    {{-- Modal Hapus Modul SIP --}}
    @foreach ($moduls as $mod)
        <div class="modal fade" id="hapusModulModal{{ $mod->id }}" tabindex="-1"
            aria-labelledby="hapusLabel{{ $mod->id }}" aria-hidden="true" style="z-index:1050;">
            <div class="modal-dialog modal-dialog-centered custom-modal">
                <div class="modal-content rounded-2xl shadow-lg border-0">

                    {{-- Header --}}
                    <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                        <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusLabel{{ $mod->id }}">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                            Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body text-center py-3 px-3">
                        <i class="bi bi-trash3-fill text-danger fs-3 mb-2"></i>
                        <p class="fw-semibold text-gray-700 mt-4 mb-2" style="font-size: 0.9rem;">
                            Apakah anda yakin ingin menghapus modul <br>
                            <span class="text-danger">"{{ $mod->judul }}"</span>?
                        </p>
                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                        <form action="{{ route('modul.destroy', $mod->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3 py-1 rounded-pill shadow-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button"
                                class="btn btn-primary btn-sm px-3 py-1 rounded-pill shadow-sm"
                                data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- FLOATING BUTTON --}}
    @auth
        @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
            <a href="{{ route('modul.create', ['prodiklat' => 'SIP']) }}"
            class="fixed bottom-6 right-6 z-[9999] w-14 h-14 flex items-center justify-center
                    rounded-full shadow-xl text-white text-2xl
                    bg-[#800000] hover:bg-[#660000]
                    transform transition"
            title="Tambah Modul">
                <i class="bi bi-plus"></i>
            </a>
        @endif
    @endauth

</x-app-layout>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="modal fade" id="notifModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content text-center p-4" style="border-radius: 10px; background-color: #ffffff; color: #065f46;">
                                {{-- Icon Centang --}}
                                <div class="mb-2">
                                    <div class="bg-green-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                {{-- Pesan --}}
                                <p class="mb-2 text-sm font-medium">{{ session('success') }}</p>
                                {{-- Tombol --}}
                                <button type="button" class="btn btn-success btn-sm px-3 py-1" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            new bootstrap.Modal(document.getElementById('notifModal')).show();
                        });
                    </script>
                @endif
