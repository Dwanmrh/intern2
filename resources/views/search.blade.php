<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Pencarian: "{{ request('search') }}"
        </h2>
    </x-slot>

    <div class="py-12 space-y-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Informasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $search = strtolower(request('search'));
                    @endphp

                    @if(Str::contains('Nama Pimpinan Jabatan', $search))
                        <div class="bg-white rounded shadow overflow-hidden">
                            <img src="{{ asset('assets/images/kalemdiklat.jpg') }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">Nama Pimpinan</h5>
                                <p class="text-gray-600">Jabatan</p>
                            </div>
                        </div>
                    @endif
                    <!-- Tambahkan card lain jika perlu -->
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Berita</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @if(Str::contains('Kasetukpa Jabatan', $search))
                        <div class="bg-white rounded shadow overflow-hidden">
                            <img src="{{ asset('assets/images/berita1.png') }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">Nama Pimpinan</h5>
                                <p class="text-gray-600">Jabatan</p>
                            </div>
                        </div>
                    @endif
                    <!-- Tambahkan card lain jika perlu -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
