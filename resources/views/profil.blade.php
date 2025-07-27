{{-- resources/views/profil.blade.php --}}
<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol Tambah --}}
            <div class="mb-4 text-end">
                <a href="{{ route('pimpinan.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    + Tambah Pimpinan
                </a>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Kartu Data Pimpinan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($data as $pimpinan)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($pimpinan->foto)
                            <img src="{{ asset('storage/' . $pimpinan->foto) }}" alt="Foto Pimpinan"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada foto
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $pimpinan->nama }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ $pimpinan->jabatan }}</p>

                            {{-- Tombol edit dan hapus --}}
                            <div class="flex justify-between">
                                <a href="{{ route('pimpinan.edit', $pimpinan->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Edit</a>

                                <form action="{{ route('pimpinan.destroy', $pimpinan->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada data pimpinan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
