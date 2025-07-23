<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/images/setukpa1.jpg') }}" class="img-fluid rounded shadow" alt="Profil Setukpa" style="max-height: 400px; object-fit: cover;">
                </div>
                <h3 class="text-lg font-bold mb-2">Profil SETUKPA LEMDIKLAT POLRI</h3>
                <p class="mb-2">Sekolah Pembentukan Perwira (Setukpa) Lembaga Pendidikan dan Pelatihan Kepolisian Negara Republik Indonesia (Lemdiklat Polri) merupakan lembaga pendidikan yang memiliki peran strategis dalam mencetak perwira-perwira terbaik untuk menjaga keamanan dan ketertiban masyarakat.</p>
                <p class="mb-2">Setukpa berlokasi di Sukabumi dan dikenal sebagai pusat pendidikan unggulan yang terus berinovasi dalam pengembangan kurikulum, fasilitas pendidikan, dan peningkatan kualitas personel.</p>
                <p>Melalui pendidikan yang disiplin dan modern, diharapkan para lulusan Setukpa mampu menjadi pemimpin Polri yang tangguh dan mampu menjawab tantangan zaman.</p>
            </div>
        </div>
    </div>
</x-app-layout>
