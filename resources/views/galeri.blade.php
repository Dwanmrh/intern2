<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('assets/images/lemdiklat_card3.jpg') }}" class="fixed-card-img w-100" alt="Kalemdiklat Polri" />
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Nama Pimpinan</h5>
                                    <p class="card-text">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('assets/images/sipls2.jpg') }}" class="fixed-card-img w-100" alt="Kasetukpa" />
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Nama Pimpinan</h5>
                                    <p class="card-text">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('assets/images/sipls1.jpg') }}" class="fixed-card-img w-100" alt="Wakasetukpa" />
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Nama Pimpinan</h5>
                                    <p class="card-text">Jabatan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
