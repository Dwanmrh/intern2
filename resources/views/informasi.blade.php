<x-app-layout>

    <div class="mb-4 text-end">
    <a href="{{ route('informasi.create') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
        + Tambah Informasi
    </a>
</div>

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Grid Informasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @forelse ($informasi as $item)
    <div class="card-kegiatan bg-white rounded-lg shadow hover:shadow-md overflow-hidden flex flex-col">
        @if ($item->foto)
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="h-40 w-full object-cover" />
        @else
            <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-600">Tidak ada gambar</div>
        @endif

        <div class="p-3 flex-grow flex flex-col justify-between">
            <div>
                <h5 class="font-semibold text-sm mb-1 truncate">{{ $item->judul }}</h5>
                <p class="text-xs text-gray-600 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                <p class="text-[11px] text-gray-400 mt-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between mt-2 text-sm">
                <a href="{{ route('informasi.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('informasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus informasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-600">Belum ada informasi yang ditambahkan.</p>
@endforelse

            </div>

            {{-- Kontak dan Media Sosial --}}
            <div class="mt-16 bg-gray-200 rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold mb-4">Kontak Dan Media Sosial</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#" class="bg-white shadow p-3 rounded-lg w-24 text-xs flex flex-col items-center hover:shadow-md">
                        <i class="bi bi-instagram text-xl mb-1"></i> Instagram
                    </a>
                    <a href="#" class="bg-white shadow p-3 rounded-lg w-24 text-xs flex flex-col items-center hover:shadow-md">
                        <i class="bi bi-youtube text-xl mb-1"></i> YouTube
                    </a>
                    <a href="#" class="bg-white shadow p-3 rounded-lg w-24 text-xs flex flex-col items-center hover:shadow-md">
                        <i class="bi bi-tiktok text-xl mb-1"></i> TikTok
                    </a>
                    <a href="#" class="bg-white shadow p-3 rounded-lg w-24 text-xs flex flex-col items-center hover:shadow-md">
                        <i class="bi bi-telephone text-xl mb-1"></i> Telpon
                    </a>
                </div>
            </div>

            {{-- Peta --}}
            <div class="mt-10 mb-16 w-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.305004477184!2d106.90528948715817!3d-6.911367899999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848356fffffff%3A0xf319c6be506068e7!2sEducational%20Establishment%20Officer!5e0!3m2!1sen!2sid!4v1753245232528!5m2!1sen!2sid"
                    width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md"></iframe>
            </div>
        </div>
    </div>
</x-app-layout>
