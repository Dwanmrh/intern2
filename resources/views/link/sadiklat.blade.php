<x-app-layout>
    @section('title', 'SADIKLAT | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="shadow rounded-lg p-6 mb-10 relative" style="background-color: rgba(255, 255, 255, 0.60); min-height: 64px;">
                <div class="relative flex items-center justify-center border-b pb-2 mb-4">
                    <div class="flex items-center space-x-2">
                        <i class="bi bi-mortarboard text-2xl text-blue-800"></i>
                        <h2 class="text-2xl font-bold text-[#2c3e50]">SADIKLAT</h2>
                    </div>
                </div>

                {{-- Tombol Kembali --}}
                <div class="absolute left-4 top-4">
                    <a href="{{ route('link.index') }}"
                    class="inline-flex items-center px-3 py-1.5 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium rounded transition duration-200">
                        ← Kembali
                    </a>
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Grid SADIKLAT --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @forelse ($sadiklat as $item)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col hover:scale-105 transition duration-300 ease-in-out relative">

                            {{-- Bagian yang bisa diklik --}}
                            <a href="{{ $item->url }}" target="_blank" class="flex flex-col text-inherit no-underline cursor-pointer">
                                @if ($item->logo)
                                    <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama }}"
                                        class="w-full h-48 object-contain p-4 bg-gray-50">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-600">
                                        Tidak ada logo
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-800 text-center">
                                        {{ $item->nama }}
                                    </h3>
                                </div>
                            </a>

                            {{-- Aksi Edit & Hapus --}}
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex justify-end gap-4 px-4 pb-4 mt-auto">
                                        <a href="{{ route('link.edit', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition" title="Edit" @click.stop>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                        </a>

                                        <button type="button"
                                                class="text-red-600 hover:text-red-800 transition"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusSadiklatModal{{ $item->id }}"
                                                title="Hapus"
                                                @click.stop>
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
                    @empty
                        <p class="text-gray-600 col-span-3 text-center">Belum ada data SADIKLAT.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    @foreach($sadiklat as $item)
        <div class="modal fade" id="hapusSadiklatModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusSadiklatLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="hapusSadiklatLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus <strong>{{ $item->nama }}</strong> dari daftar SADIKLAT?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('link.destroy', $item->id) }}" method="POST">
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
