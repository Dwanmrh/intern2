<x-app-layout>
    @section('title', 'Detail Modul | SETUKPA LEMDIKLAT POLRI')

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD DETAIL --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-6">
                    📘 {{ $modul->judul }}
                </h2>

                {{-- DETAIL INFO --}}
                <table class="w-full text-sm text-left text-gray-600 mb-6">
                    <tbody>
                        @if($modul->deskripsi)
                        <tr class="border-b">
                            <th class="py-3 px-4 font-semibold w-1/4">Deskripsi</th>
                            <td class="py-3 px-4">{{ $modul->deskripsi }}</td>
                        </tr>
                        @endif
                        @if($modul->prodiklat)
                        <tr class="border-b">
                            <th class="py-3 px-4 font-semibold">Prodiklat</th>
                            <td class="py-3 px-4">{{ $modul->prodiklat }}</td>
                        </tr>
                        @endif
                        @if($modul->periode)
                        <tr class="border-b">
                            <th class="py-3 px-4 font-semibold">Periode</th>
                            <td class="py-3 px-4">{{ $modul->periode }}</td>
                        </tr>
                        @endif
                        @if($modul->mapel)
                        <tr class="border-b">
                            <th class="py-3 px-4 font-semibold">Mata Pelajaran</th>
                            <td class="py-3 px-4">{{ $modul->mapel }}</td>
                        </tr>
                        @endif
                        @if($modul->tahun)
                        <tr class="border-b">
                            <th class="py-3 px-4 font-semibold">Tahun</th>
                            <td class="py-3 px-4">{{ $modul->tahun }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th class="py-3 px-4 font-semibold">File PDF</th>
                            <td class="py-3 px-4">
                                <a href="{{ asset('storage/'.$modul->file) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                   📄 Lihat / Unduh PDF
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- PREVIEW FILE PDF --}}
                <div class="mb-6">
                    <iframe src="{{ asset('storage/'.$modul->file) }}"
                            class="w-full h-[600px] border rounded-lg shadow"></iframe>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-3">
                    <a href="{{ route('modul.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        ⬅ Kembali
                    </a>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('modul.edit', $modul->id) }}"
                               class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                ✏ Edit
                            </a>

                            <form action="{{ route('modul.destroy', $modul->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus modul ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    🗑 Hapus
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

