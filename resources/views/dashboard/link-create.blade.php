<x-app-layout>
    @section('title', 'TAMBAH LINK | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header Tengah --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Link</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('dashboard.link.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="nama"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                               focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan nama link">
                </div>

                {{-- URL --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">URL</label>
                    <input type="url" name="url"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                               focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="https://contoh.com">
                </div>

                {{-- Logo --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload Logo</label>
                    <input type="file" name="logo" id="logoInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">

                    {{-- Preview --}}
                    <div id="logoPreviewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview Logo:</p>
                        <div id="logoPreviewWrapper" class="rounded-md shadow-md"></div>
                    </div>
                </div>

                <script>
                    document.getElementById('logoInput').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const previewContainer = document.getElementById('logoPreviewContainer');
                        const previewWrapper = document.getElementById('logoPreviewWrapper');

                        previewWrapper.innerHTML = "";

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

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3 mt-4">
                    <a href="{{ route('dashboard.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
