<x-app-layout>

    @section('title', 'MODUL PAG | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="shadow rounded-lg p-6 mb-10"
                style="background-color: rgba(255, 255, 255, 0.95);">

                {{-- BARIS ATAS: KEMBALI + JUDUL + TAMBAH --}}
                <div class="grid grid-cols-3 items-center mb-6">

                    {{-- Tombol Kembali (kiri) --}}
                    <div class="flex items-center">
                        <a href="{{ route('modul.index') }}"
                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-700 to-gray-800
                                hover:from-gray-800 hover:to-black text-white text-sm font-medium rounded-lg shadow transition">
                                <i class="bi-chevron-left"></i> Kembali
                        </a>
                    </div>

                    {{-- JUDUL (tengah, selalu center) --}}
                    <div class="text-center">
                        <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white
                                inline-flex items-center gap-2
                                bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800 px-6 py-1
                                rounded-xl shadow-md">
                            <i class="bi bi-person-workspace text-xl md:text-xl"></i>
                            MODUL PAG
                        </h2>
                    </div>

                    <div class="flex justify-end items-center">
                    </div>
                </div>

                {{-- BARIS FILTER --}}
                <form method="GET" action="{{ route('modul.pag') }}" class="flex flex-wrap items-center gap-3 mb-6">
                    <select name="tahun"
                            class="form-select text-sm rounded-md w-auto min-w-[100px] max-w-[130px]
                            bg-gray-100
                            text-black border border-gray-300 focus:border-blue-400 focus:ring-blue-300">
                        <option value="">Pilih Tahun</option>
                        @foreach ($allTahun as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    <button class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded-lg shadow transition">
                    <i class="bi bi-search mr-1"></i>Search
                    </button>
                </form>

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
                                            <div class="inline-flex items-center bg-red-600 text-white px-3 py-1.5 rounded text-sm font-bold">
                                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 2C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2H6ZM13 3.5L18.5 9H13V3.5ZM9 13H11C11.55 13 12 13.45 12 14V16C12 16.55 11.55 17 11 17H9V13ZM13 13H15.5C16.33 13 17 13.67 17 14.5V15.5C17 16.33 16.33 17 15.5 17H13V13Z"/>
                                                </svg>
                                                PDF
                                            </div>
                                            <div>
                                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="font-semibold text-[#2c3e50] hover:underline">
                                                    {{ $modul->judul }}
                                                </a>
                                                <p class="text-sm text-gray-600">{{ $modul->deskripsi ?? '-' }}</p>
                                                <p class="text-xs text-gray-500">Tahun: {{ $modul->tahun ?? '-' }} </p>
                                            </div>
                                        </div>

                                        {{-- Aksi Edit & Hapus --}}
                                        @auth
                                            @if(in_array(Auth::user()->role, ['admin', 'personel']))
                                                <div class="flex justify-end gap-2 mt-2">
                                                    <a href="{{ route('modul.edit', $modul->id) }}" @click.stop
                                                    class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 shadow-md transition" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                        </svg>
                                                    </a>

                                                    <button type="button" @click.stop
                                                            class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 shadow-md transition"
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

                                                {{-- Modal Hapus Modul PAG --}}
                                                <div class="modal fade" id="hapusModulModal{{ $modul->id }}" tabindex="-1"
                                                    aria-labelledby="hapusLabel{{ $modul->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered custom-modal">
                                                        <div class="modal-content rounded-2xl shadow-lg border-0">

                                                            {{-- Header --}}
                                                            <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                                                                <h5 class="modal-title d-flex align-items-center gap-2 fs-6" id="hapusLabel{{ $modul->id }}">
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
                                                                    <span class="text-danger">"{{ $modul->judul }}"</span>?
                                                                </p>
                                                            </div>

                                                            {{-- Footer --}}
                                                            <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                                                                <form action="{{ route('modul.destroy', $modul->id) }}" method="POST">
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

    {{-- FLOATING BUTTON --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('modul.create', ['prodiklat' => 'PAG']) }}"
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
                            <div class="modal-content text-center p-4" style="border-radius: 10px; background-color: #d1fae5; color: #065f46;">
                                {{-- Icon Centang --}}
                                <div class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
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