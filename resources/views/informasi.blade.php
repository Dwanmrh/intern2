<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kegiatan Terbaru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div id="info1" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/kalemdiklat.jpg') }}" alt="Kalemdiklat Polri" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Jadwal Ujian Akhir</h5>
                            <p class="text-gray-600">Jadwal pelaksanaan ujian akhir semester SETUKPA.</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div id="info2" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/lemdiklat_card3.jpg') }}" alt="Kasetukpa" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Pengumuman Kelulusan</h5>
                            <p class="text-gray-600">Daftar peserta yang lulus pendidikan.</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div id="info3" class="bg-white rounded shadow overflow-hidden">
                        <img src="{{ asset('assets/images/berita5.jpg') }}" alt="Wakasetukpa" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Pendaftaran Pelatihan</h5>
                            <p class="text-gray-600">Program pelatihan tambahan untuk peserta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
