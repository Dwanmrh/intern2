<x-app-layout>
    @section('title', 'EDIT LINK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-semibold text-center mb-4">Edit Link</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-4 py-2 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('dashboard.link.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $link->nama) }}"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan nama link">
                </div>

                {{-- URL --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">URL</label>
                    <input type="url" name="url" value="{{ old('url', $link->url) }}"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="https://contoh.com">
                </div>

                {{-- Logo Lama --}}
                @if($link->logo)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">Logo Saat Ini</label>
                        <img src="{{ asset('storage/' . $link->logo) }}" alt="{{ $link->nama }}"
                             class="h-20 object-contain rounded-md shadow-md mb-2">

                        {{-- Checkbox Hapus Logo Lama --}}
                        <div class="flex items-center space-x-2 bg-red-600/20 px-3 py-2 rounded-lg">
                            <input type="checkbox" id="hapusLogo" name="hapus_logo" value="1"
                                class="w-4 h-4 text-red-600 border-red-500 rounded focus:ring-red-500">
                            <label for="hapusLogo" class="text-red-500 font-semibold hover:text-red-400 text-sm transition">
                                Hapus logo lama
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Ganti Logo --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Ganti Logo (Opsional)</label>
                    <input type="file" name="logo" id="logoInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <small class="font-bold text-yellow-400 italic">Max Size 15 MB</small>

                    {{-- Preview Logo Baru --}}
                    <div id="logoPreviewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview Logo Baru:</p>
                        <div id="logoPreviewWrapper" class="rounded-md shadow-md"></div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-2 pt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Perbarui
                    </button>

                    <a href="{{ route('dashboard.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Batal
                    </a>
                </div>
            </form>

            {{-- Script Preview --}}
            <script>
                document.getElementById('logoInput').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    const previewContainer = document.getElementById('logoPreviewContainer');
                    const previewWrapper = document.getElementById('logoPreviewWrapper');

                    previewWrapper.innerHTML = ""; // reset isi preview

                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('w-40', 'rounded-md', 'shadow-md');
                            previewWrapper.appendChild(img);
                            previewContainer.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.classList.add('hidden');
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>