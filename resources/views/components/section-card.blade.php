@props(['title', 'link'])

<div class="card shadow rounded-lg p-4 bg-white">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-xl font-bold text-[#2c3e50]">{{ $title }}</h2>
        @if($link)
            <a href="{{ $link }}"
               class="text-sm text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-1">
                Lihat Lebih Lanjut
                <i class="bi bi-box-arrow-up-right text-base"></i>
            </a>
        @endif
    </div>
    <div class="mt-2">
        {{ $slot }}
    </div>
</div>
