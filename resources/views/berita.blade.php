<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div id="berita1" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/berita1.png') }}" alt="Kasetukpa" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Penerimaan Siswa Baru</h5>
                            <p class="text-gray-600">Informasi mengenai proses seleksi siswa SETUKPA.</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div id="berita2" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/berita2.png') }}" alt="Kasetukpa" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Upacara Hari Bhayangkara</h5>
                            <p class="text-gray-600">Peringatan Hari Bhayangkara ke-78 di SETUKPA.</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div id="berita3" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/berita4.jpg') }}" alt="Tim Multimedia" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Kegiatan Donor Darah</h5>
                            <p class="text-gray-600">Aksi sosial donor darah bersama siswa dan staf.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
