{{-- resources/views/profil.blade.php --}}
<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           {{-- Button Tambah --}}
@auth
    @if(Auth::user()->role === 'admin')
        <div class="mb-3 text-end position-relative z-10">
            <a href="{{ route('profil.create') }}" class="btn btn-primary">
                + Tambah Pimpinan
            </a>
        </div>
    @endif
@endauth

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card Pimpinan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($data as $profil)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($profil->foto)
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Pimpinan"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada foto
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $profil->nama }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ $profil->jabatan }}</p>

                            {{-- BUtton Edit & Delete --}}
                            <div class="flex justify-between">
                                <a href="{{ route('profil.edit', $profil->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Edit</a>

                                <form action="{{ route('profil.destroy', $profil->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada data pimpinan yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
